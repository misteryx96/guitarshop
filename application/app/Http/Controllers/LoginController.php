<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Korisnik;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'tbUsername' => 'required|alpha',
        ]);

        $username = $request->get('tbUsername');
        $pass = $request->get('tbPass');

        $korisnik = new Korisnik();
        $korisnik->username = $username;
        $korisnik->pass = $pass;

        $loginKorisnik = $korisnik->getByUsernameAndPass();

        if(!empty($loginKorisnik)){
            $request->session()->push('user', $loginKorisnik);
            if($loginKorisnik->username == 'adminko'){
                $request->session()->push('isAdmin', true);
            }
            return redirect()->route('home')->with('success', 'Uspesno ste se ulogovali!');
        }
        return redirect()->back()->with('error', 'Niste reg');
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        $request->session()->forget('isAdmin');
        $request->session()->flush();
        return redirect('/');
    }
}
