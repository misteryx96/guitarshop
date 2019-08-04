<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $data = [];

    public function index(){
        return view('pages.home');
    }

    public function logreg(){
        return view('pages.logreg');
    }

    public function verify(){
        return view('emails.verifyUser');
    }

    public function login(Request $request){
        $user = $request->get('tbKorisnickoIme');
        $pass = $request->get('tbLozinka');
        $this->data['user'] = $user;
        $this->data['pass'] = $pass;
        return view('pages.login', $this->data);
    }

}

