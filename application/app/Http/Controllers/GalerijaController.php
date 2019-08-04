<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Guit;
use App\Models\Autor;
use App\Models\Galerija;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GalerijaController extends Controller
{
    private $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }

    public function gallery(){
        $gall = new Galerija();
        $this->data['galls'] = $gall->getAll();
        return view('pages.gallery', $this->data);
    }

    public function show($id = null){
        $galerija = new Galerija();
        $this->data['galerije'] = $galerija->getAllnoPaginate();

        if(!empty($id)){
            $galerija->id = $id;
            $this->data['galerija'] = $galerija->get($galerija);
        }

        return view('pages.adminGalerija', $this->data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'tbNaziv' => 'unique:galerija,naziv|regex:/^[A-Z]{1}[a-z]{2,20}$/',
            'tbPic' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        $naziv = $request->get('tbNaziv');

        $pic = $request->file('tbPic');

        $temp_path = $pic->getPathname();
        $ext = $pic->getClientOriginalExtension();
        $picName = time() . '.' . $ext;
        $path = 'pics/gallery/' . $picName;
        $server_path = public_path($path);

        try{
            //File::move($temp_path, $server_path);
	    $pic->move('pics/gallery/', $picName);
            $galerija = new Galerija();
            $galerija->naziv = $naziv;
            $galerija->putanja_slike = $path;

            $result = $galerija->save();

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

        $pic = $request->file('tbPic');

        $galerija = new Galerija();
        $galerija->id = $id;
        $galerija->naziv = $naziv;

        if(!empty($pic)){

            $gall_to_update = $galerija->get();
            File::delete($gall_to_update->putanja_slike);

            $temp_path = $pic->getPathname();
            $ext = $pic->getClientOriginalExtension();
            $picName = time() . '.' . $ext;
            $path = 'pics/gallery/' . $picName;
            $server_path = public_path($path);

            //File::move($temp_path, $server_path);
	    $pic->move('pics/gallery/', $picName);

            $galerija->putanja_slike = $path;
        }

        $rez = $galerija->update();

        if($rez == 1){ // ako je uspeo update
            return redirect('/galls')->with('message','Uspesan update!');
        }
        else {
            return redirect('/galls')->with('message','Greska pri update-u!');
        }
    }

    public function destroy($id){
        $galerija = new Galerija();
        $galerija->id = $id;

        // brisanje stare slike sa servera
        $gall_to_update = $galerija->get($id);
        File::delete($gall_to_update->putanja_slike);

        $rez = $galerija->delete();
        if($rez == 1){
            return redirect('/galls')->with('message','Uspesan delete!');
        }
        else {
            return redirect('/gallss')->with('message','Greska pri delete-u!');
        }
    }

}