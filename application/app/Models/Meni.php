<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/6/2018
 * Time: 6:14 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Meni
{
    public $id;
    public $naziv;
    public $link;

    public function getAll(){
        $rezultat = DB::table('meni')->get();
        return $rezultat;
    }

    public function get(){
        $rezultat =
            DB::table('meni')
                ->select('*')
                ->where('id', $this->id)
                ->first();
        return $rezultat;
    }

    public function save() {
        $rezultat = DB::table('meni')->insert([
            'id' => $this->id,
            'naziv' => $this->naziv,
            'link' => $this->link
        ]);
        return $rezultat;
    }

    public function update(){
        $data = [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'link' => $this->link
        ];

        $rez = DB::table('meni')
            ->where('id',$this->id)
            ->update($data)
        ;
        return $rez;
    }

    public function delete(){
        $rezultat = DB::table('meni')
            ->where('id', $this->id)
            ->delete();
        return $rezultat;
    }
}