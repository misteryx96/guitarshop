<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/9/2018
 * Time: 5:49 PM
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

class MeniController extends Controller
{
    private $data = [];

    public function show($id = null){
        $menu = new Meni();
        $this->data['menus'] = $menu->getAll();

        if(!empty($id)){
            $menu->id = $id;
            $this->data['menu'] = $menu->get();
        }

        return view('pages.adminMenu', $this->data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'tbNaziv' => 'unique:meni,naziv',
            'tbLink' => 'required|alpha'
        ]);

        $naziv = $request->get('tbNaziv');
        $link = $request->get('tbLink');

     /*   try{ */
            $menu = new Meni();
            $menu->naziv = $naziv;
            $menu->link = $link;
            $result = $menu->save();

            if($result == 1){
                return redirect()->route('home')->with('success', 'Uspesan unos');}
            else{
                return redirect()->route('home')->with('error', 'Neuspesan unos');}
      /*  }
        catch (\Exception $exception){
            \Log::error('Greska: ' . $exception->getMessage());
        } */
    }
}