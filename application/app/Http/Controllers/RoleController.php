<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Uloga;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Meni;

class RoleController extends Controller
{
    private $data = [];

    public function show($id = null){
        $role = new Uloga();
        $this->data['roles'] = $role->getAll();
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();

        if(!empty($id)){
            $role->id = $id;
            $this->data['role'] = $order->get();
        }

        return view('pages.adminRole', $this->data);
    }
}