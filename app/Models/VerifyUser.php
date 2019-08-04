<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VerifyUser
{

    public $user_id;
    public $token;
    public $created_at;
    public $updated_at;

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getByToken(){
        $result =
            DB::table('verify_users')
                ->select('*')
                ->where('token', $this->token)
                ->first();
        //return $result;
        $this->user_id = $result->user_id;
        $this->created_at = $result->created_at;
        $this->updated_at = $result->updated_at;
    }

    public function create(){
        $result =
            DB::table('verify_users')
                ->insert([
                    'user_id' => $this->user_id,
                    'token' => $this->token
                ]);
        return $result;
    }



}
