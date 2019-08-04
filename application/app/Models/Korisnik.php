<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 4/30/2018
 * Time: 6:47 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Korisnik
{
    public $id;
    public $username;
    public $pass;
    public $slika;
    public $uloga_id;

    public function getAll(){
        $rezultat =
            DB::table('korisnik')
                ->select('*',
                    'korisnik.id AS korisnikId')
                ->join('uloga', 'uloga.id', '=', 'korisnik.uloga_id')
                ->get();
        return $rezultat;
    }



    public function get(){
        $rezultat =
            DB::table('korisnik')
                ->select('*')
                ->where('id', $this->id)
                ->first();
        return $rezultat;
    }

    //Za Lozinku md5

    public function getByUsernameAndPass(){
        $rezultat =
            DB::table('korisnik')
                ->select('korisnik.*', 'uloga.naziv')
                ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
                ->where(['username' => $this->username, 'pass' => md5($this->pass)])
                ->first();
        return $rezultat;
    }

    // SAVE UPDATE I DELETE

    // SAVE i SAVEUSER

    public function save() {
        $rezultat = DB::table('korisnik')->insert([
            'username' => $this->username,
            'pass' => md5($this->pass),
            'slika' => $this->slika,
            'uloga_id' => $this->uloga_id
        ]);
        return $rezultat;
    }

    public function saveWithRegularUserRole(){
        $rezultat = DB::table('korisnik')->insert([
            'username' => $this->username,
            'pass' => md5($this->pass),
            'slika' => $this->slika,
            'uloga_id' => '2'
        ]);
        return $rezultat;
    }

    public function update(){
        $data = [
            'username' => $this->username,
            'pass' => md5($this->pass),
            'uloga_id' => $this->uloga_id
        ];

        if(!empty($this->slika)){ // ako je upload-ovana slika
            $data['slika'] = $this->slika;
        }

        $rez = DB::table('korisnik')
            ->where('id',$this->id)
            ->update($data)
        ;
        return $rez;
    }

    public function delete(){
        $rezultat = DB::table('korisnik')
            ->where('id', $this->id)
            ->delete();
        return $rezultat;
    }
}