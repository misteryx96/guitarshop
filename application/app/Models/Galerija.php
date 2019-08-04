<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/8/2018
 * Time: 5:09 AM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Galerija
{
    public $id;
    public $naziv;
    public $putanja_slike;

    public function getAll(){
        $rezultat = DB::table('galerija')->paginate(6);
        return $rezultat;
    }

    public function getAllnoPaginate(){
        $rezultat = DB::table('galerija')->get();
        return $rezultat;
    }

    public function get(){
        $rezultat =
            DB::table('galerija')
                ->select('*')
                ->where('id', $this->id)
                ->first();
        return $rezultat;
    }

    public function save() {
        $rezultat = DB::table('galerija')->insert([
            'naziv' => $this->naziv,
            'putanja_slike' => $this->putanja_slike
        ]);
        return $rezultat;
    }

    public function update(){
        $data = [
            'naziv' => $this->naziv
        ];

        if(!empty($this->putanja_slike)){ // ako je upload-ovana slika
            $data['putanja_slike'] = $this->putanja_slike;
        }

        $rez = DB::table('galerija')
            ->where('id',$this->id)
            ->update($data)
        ;
        return $rez;
    }

    public function delete(){
        $rezultat = DB::table('galerija')
            ->where('id', $this->id)
            ->delete();
        return $rezultat;
    }
}