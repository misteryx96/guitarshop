<?php
/**
 * Created by PhpStorm.
 * User: Mladen
 * Date: 5/8/2018
 * Time: 2:51 AM
 */

namespace App\Models;
use Illuminate\Support\Facades\DB;

class Autor
{
    public function getAll(){
        $rezultat =
            DB::table('autor')
                ->get();
        return $rezultat;
    }
}