<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/7/2018
 * Time: 10:11 PM
 */

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Meni;

class OrderController extends Controller
{
    public $data = [];

    public function __construct(){
        $meni = new Meni();
        $this->data['menus'] = $meni->getAll();
    }

    public function guit_order($id, Request $request){
        if(empty(session('user')))
            return redirect()->route('home')->with('error', 'Morate biti ulogovani da biste narucili gitaru');
        else{
            $order = new Order();
            $user_session = $request->session()->get('user')[0];
            $order->id_korisnika = $user_session->id;
            $order->id_gitara = $id;
            $order->save();
            return redirect()->route('home')->with('success', 'Uspesno ste narucili gitaru');
        }

    }

    public function show($id = null){
        $order = new Order();
        $this->data['orders'] = $order->getAll();

        if(!empty($id)){
            $order->id_narudzbina = $id;
            $this->data['order'] = $order->get();
        }

        return view('pages.adminOrder', $this->data);
    }
}