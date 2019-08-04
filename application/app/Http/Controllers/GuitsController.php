<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/8/2018
 * Time: 1:57 AM
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
use App\Models\Guit;

class GuitsController extends Controller
{
    private $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }

    public function guitars(){
        $guits = new Guit();
        $this->data['guits'] = $guits->getAll();
        return view('pages.guits', $this->data);
    }

    public function guitar_specific($id){
        $guits = new Guit();
        $this->data['guit'] = $guits->get($id);
        return view('pages.guits_show', $this->data);
    }

    public function guitarsByType($type){
        $guits = new Guit();
        $this->data['guits'] = $guits->getByType($type);
        return view('pages.guits', $this->data);
    }

    public function guitarsByMnfctr($mnfctr){
        $guits = new Guit();
        $this->data['guits'] = $guits->getByMnfctr($mnfctr);
        return view('pages.guits', $this->data);
    }

    public function show($id = null){
        $guit = new Guit();
        $this->data['guits'] = $guit->getAll();

        if(!empty($id)){
            $guit->id = $id;
            $this->data['guit'] = $guit->gets();
        }

        return view('pages.adminGuit', $this->data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'tbNaziv' => 'required|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
            'tbMarka' => 'required|alpha',
            'tbTip' => 'required|alpha',
            'tbOpis' => 'required|max:400',
            'tbCena' => 'required|alpha_num',
            'tbSlika' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        $naziv = $request->get('tbNaziv');
        $marka = $request->get('tbMarka');
        $tip = $request->get('tbTip');
        $opis = $request->get('tbOpis');
        $cena = $request->get('tbCena');
        $pic = $request->file('tbSlika');

        $temp_path = $pic->getPathname();
        $ext = $pic->getClientOriginalExtension();
        $picName = time() . '.' . $ext;
        $path = 'pics/guits/' . $picName;
        $server_path = public_path($path);

        try{
            //File::move($temp_path, $server_path);
$pic->move('pics/guits/', $picName);
            $guit = new Guit();
            $guit->naziv = $naziv;
            $guit->marka = $marka;
            $guit->tip = $tip;
            $guit->opis = $opis;
            $guit->cena = $cena;
            $guit->putanja_slike = $path;

            $result = $guit->save();

            if($result == 1){
                return redirect()->route('home')->with('success', 'Uspesan unos');}
            else{
                return redirect()->route('home')->with('error', 'Neuspesan unos');}
        }
        catch (\Exception $exception){
            \Log::error('Greska: ' . $exception->getMessage());
        }
    }

    public function update($id, Request $request) {
        $naziv = $request->get('tbNaziv');
        $marka = $request->get('tbMarka');
        $tip = $request->get('tbTip');
        $opis = $request->get('tbOpis');
        $cena = $request->get('tbCena');

        $slika = $request->file('tbSlika');

        $guit = new Guit();
        $guit->id = $id;
        $guit->naziv = $naziv;
        $guit->marka = $marka;
        $guit->tip = $tip;
        $guit->opis = $opis;
        $guit->cena = $cena;

        if(!empty($slika)){

            $guit_to_update = $guit->gets();
            File::delete($guit_to_update->putanja_slike);

            $tmp_putanja = $slika->getPathName();
            $ime_fajla = time().'.'.$slika->getClientOriginalExtension();
            $putanja = 'pics/guits/' . $ime_fajla;
            $putanja_server = public_path($putanja);

	//File::move($tmp_putanja, $putanja_server);
	$pic->move('pics/guits/', $ime_fajla);

            $guit->putanja_slike = $putanja;
        }

        $rez = $guit->update();

        if($rez == 1){ // ako je uspeo update
            return redirect('/guits')->with('message','Uspesan update!');
        }
        else {
            return redirect('/guits')->with('message','Greska pri update-u!');
        }
    }

    public function destroy($id){
        $guit = new Guit();
        $guit->id = $id;

        // brisanje stare slike sa servera
        $guit_to_update = $guit->gets();
        File::delete($guit_to_update->putanja_slike);

        $rez = $guit->delete();
        if($rez == 1){
            return redirect('/guits')->with('message','Uspesan delete!');
        }
        else {
            return redirect('/guits')->with('message','Greska pri delete-u!');
        }
    }

}