<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/9/2018
 * Time: 7:23 PM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

// THIS CLASS IS MY ROLE MODEL (PUN INTENDED)

class Role
{

    public $id;
    public $naziv;

    public function getAll(){
        $rezultar = DB::table('uloga')->get();
        return $rezultar;
    }

}