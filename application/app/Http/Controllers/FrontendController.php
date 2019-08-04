<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meni;
use App\Models\Guit;
use App\Models\Autor;
use App\Http\Controllers\Response;

class FrontendController extends Controller
{
    private $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }

    public function index(){
        return view('pages.home', $this->data);
    }

    public function autor(){
        $autor = new Autor();
        $this->data['mine'] = $autor->getAll();
        return view('pages.mine', $this->data);
    }

    public function login_page(){
        return view('pages.login', $this->data);
    }

    public function reg_page(){
        return view('pages.reg', $this->data);
    }

    public function doc(){
        $file = base_path() . '/' . 'public/pics/doc.pdf';
        return response()->download($file);
    }

    public function admin_panel(){
        return view('pages.admin_panel', $this->data);
    }
}
