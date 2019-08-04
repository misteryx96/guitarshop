<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/7/2018
 * Time: 6:19 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Guit
{
    public $id;
    public $naziv;
    public $marka;
    public $tip;
    public $opis;
    public $putanja_slike;
    public $cena;

    public function getAll(){
        $rezultat = DB::table('gitare')->get();
        return $rezultat;
    }

    public function get($id){
        $rezultat =
            DB::table('gitare')
                ->select('*')
                ->where('id_gitara', $id)
                ->first();
        return $rezultat;
    }

    public function gets(){
        $rezultat =
            DB::table('gitare')
                ->select('*')
                ->where('id_gitara', $this->id)
                ->first();
        return $rezultat;
    }

    public function getByType($type){
        $rezultat =
            DB::table('gitare')
                ->select('*')
                ->where('tip', $type)
                ->get();
        return $rezultat;
    }

    public function getByMnfctr($mnfctr){
        $rezultat =
            DB::table('gitare')
                ->select('*')
                ->where('marka', $mnfctr)
                ->get();
        return $rezultat;
    }

    public function save() {
        $rezultat = DB::table('gitare')->insert([
            'naziv' => $this->naziv,
            'marka' => $this->marka,
            'tip' => $this->tip,
            'opis' => $this->opis,
            'putanja_slike' => $this->putanja_slike,
            'cena' => $this->cena
        ]);
        return $rezultat;
    }

    public function update(){
        $data = [
            'naziv' => $this->naziv,
            'marka' => $this->marka,
            'tip' => $this->tip,
            'opis' => $this->opis,
            'cena' => $this->cena
        ];

        if(!empty($this->putanja_slike)){ // ako je upload-ovana slika
            $data['putanja_slike'] = $this->putanja_slike;
        }

        $rez = DB::table('gitare')
            ->where('id_gitara',$this->id)
            ->update($data)
        ;
        return $rez;
    }

    public function delete(){
        $rezultat = DB::table('gitare')
            ->where('id_gitara', $this->id)
            ->delete();
        return $rezultat;
    }
}