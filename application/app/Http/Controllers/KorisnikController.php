<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/3/2018
 * Time: 9:05 PM
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Korisnik;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Meni;
use App\Models\Uloga;

class KorisnikController extends Controller
{
    private $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
        $uloga = new Uloga();
        $this->data['uloge'] = $uloga->getAll();
    }

    public function store(Request $request){
     /*   $this->validate($request, [
            'tbUsername' => 'unique:korisnik,username',
            'tbPass' => 'required|alpha',
            'tbPic' => 'required|mimes:jpg,jpeg,png,gif'
        ]); */

        $this->validate($request, [
            [
                'tbUsername' => 'regex:/^[a-z]+(\s[\w\d\-]+)*$/|unique:korisnik,username',
                'tbPass' => 'required|alpha_num',
                'tbPic' => 'required|mimes:jpg,jpeg,png,gif',
                'ddlUloga' => 'required|not_in:0'
            ],
            [
                'required' => 'Polje :attribute je obavezno!',
                'tbUsername.regex' => 'Polje username nije u ispravnom formatu!',
                'mimes' => 'Dozvoljeni formati su: :values.'
            ]
        ]);

        $userName = $request->get('tbUsername');
        $pass = $request->get('tbPass');
        $pic = $request->file('tbPic');

        $temp_path = $pic->getPathname();
        $ext = $pic->getClientOriginalExtension();
        $picName = time() . '.' . $ext;
        $path = 'pics/' . $picName;
        $server_path = public_path($path);

        try{
            //File::move($temp_path, $server_path);
	    $pic->move('pics/', $picName);
            $korisnik = new Korisnik();
            $korisnik->username = $userName;
            $korisnik->pass = $pass;
            $korisnik->slika = $path;

            $result = $korisnik->saveWithRegularUserRole();

            if($result == 1){
                return redirect()->route('home')->with('success', 'Uspesan unos');}
            else{
                return redirect()->route('home')->with('error', 'Neuspesan unos');}
        }
        catch (\Exception $exception){
            \Log::error('Greska: ' . $exception->getMessage());
return redirect()->route('home')->with('error', 'Greska u radu');
        }
    }

    public function storeWithChosenRole(Request $request){
        $this->validate($request, [
            'tbUsername' => 'unique:korisnik,username',
            'tbPass' => 'required|alpha_num',
            'tbPic' => 'required|mimes:jpg,jpeg,png,gif',
            'ddlUloga' => 'required|not_in:0'
        ]);

        $userName = $request->get('tbUsername');
        $pass = $request->get('tbPass');
        $pic = $request->file('tbPic');
        $role = $request->get('ddlUloga');

        $temp_path = $pic->getPathname();
        $ext = $pic->getClientOriginalExtension();
        $picName = time() . '.' . $ext;
        $path = 'pics/' . $picName;
        $server_path = public_path($path);

        try{
            //File::move($temp_path, $server_path);
	    $pic->move('pics/', $picName);
            $korisnik = new Korisnik();
            $korisnik->username = $userName;
            $korisnik->pass = $pass;
            $korisnik->slika = $path;
            $korisnik->uloga_id = $role;
            $result = $korisnik->save();

            if($result == 1){
                return redirect()->route('home')->with('success', 'Uspesan unos');}
            else{
                return redirect()->route('home')->with('error', 'Neuspesan unos');}
        }
        catch (\Exception $exception){
            \Log::error('Greska: ' . $exception->getMessage());
        }
    }

    public function show($id = null){
        $korisnik = new Korisnik();
        $this->data['korisnici'] = $korisnik->getAll();

        if(!empty($id)){
            $korisnik->id = $id;
            $this->data['korisnik'] = $korisnik->get();
        }

        return view('pages.adminKorisnik', $this->data);
    }

    public function update($id, Request $request) {
        $korisnicko_ime = $request->get('tbUsername');
        $lozinka = $request->get('tbPass');
        $uloga_id = $request->get('ddlUloga');

        $slika = $request->file('tbPic');

        $korisnik = new Korisnik();
        $korisnik->id = $id;
        $korisnik->username = $korisnicko_ime;
        $korisnik->pass = $lozinka;
        $korisnik->uloga_id = $uloga_id;

        if(!empty($slika)){

            $korisnik_to_update = $korisnik->get();
            File::delete($korisnik_to_update->slika);

            $tmp_putanja = $slika->getPathName();
            $ime_fajla = time().'.'.$slika->getClientOriginalExtension();
            $putanja = 'pics/' . $ime_fajla;
            $putanja_server = public_path($putanja);

            //File::move($tmp_putanja, $putanja_server);
	    $slika->move('pics/', $ime_fajla);

            $korisnik->slika = $putanja;
        }

        $rez = $korisnik->update();

        if($rez == 1){ // ako je uspeo update
            return redirect('/users')->with('message','Uspesan update!');
        }
        else {
            return redirect('/users')->with('message','Greska pri update-u!');
        }
    }

    public function destroy($id){
        $korisnik = new Korisnik();
        $korisnik->id = $id;

        $korisnik_to_update = $korisnik->get();
        File::delete($korisnik_to_update->slika);

        $rez = $korisnik->delete();
        if($rez == 1){
            return redirect('/users')->with('message','Uspesan delete!');
        }
        else {
            return redirect('/users')->with('message','Greska pri delete-u!');
        }
    }
}