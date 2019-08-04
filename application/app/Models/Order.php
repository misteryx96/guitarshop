<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/7/2018
 * Time: 10:03 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Order
{
    public $id_narudzbina;
    public $id_gitara;
    public $id_korisnika;

    public function getAll(){
        $rezultar = DB::table('narudzbina')->
            join('gitare', 'gitare.id_gitara', '=', 'narudzbina.id_gitara')->
            join('korisnik', 'id', '=', 'narudzbina.id_korisnika')->
            get();
        return $rezultar;
    }

    public function get(){
        $rezultat = DB::table('narudzbina')
                ->select('*')
                ->where('id_narudzbina', $this->id_narudzbina)
                ->first();
        return $rezultat;
    }

    public function save() {
        $rezultat = DB::table('narudzbina')->insert([
            'id_gitara' => $this->id_gitara,
            'id_korisnika' => $this->id_korisnika
        ]);
        return $rezultat;
    }

    public function update(){
        $data = [
            'id_gitara' => $this->id_gitara,
            'id_korisnika' => $this->id_korisnika
        ];

        $rez = DB::table('narudzbina')
            ->where('id',$this->id_narudzbina)
            ->update($data)
        ;
        return $rez;
    }

    public function delete(){
        $rezultat = DB::table('narudzbina')
            ->where('id', $this->id_narudzbina)
            ->delete();
        return $rezultat;
    }
}