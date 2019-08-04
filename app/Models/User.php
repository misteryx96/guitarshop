<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User
{

    public $id;
    public $name_surname;
    public $email;
    public $phone;
    public $user;
    public $pass;
    public $remember_token;
    public $created_at;
    public $updated_at;
    public $verified;
    public $token;

    public function verifyUser(){
        return $this->hasOne('App\Models\VerifyUser');
    }

    public function getAll(){
        $result =
            DB::table('users')
                ->select('*',
                    'users.id AS userId')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->get();
        return $result;
    }

    public function get(){
        $result =
            DB::table('users')
                ->select('*')
                ->where('id', '=', $this->id)
                ->first();
        //return $result;
        $this->name_surname = $result->name_surname;
        $this->email = $result->email;
        $this->phone = $result->phone;
        $this->user = $result->user;
        $this->pass = $result->pass;
        $this->remember_token = $result->remember_token;
        $this->created_at = $result->created_at;
        $this->updated_at = $result->updated_at;
        $this->verified = $result->verified;
    }

    public function getByUserAndPass(){
        $result =
            DB::table('users')
                ->select('users.*', 'roles.name')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where(['user' => $this->user, 'pass' => md5($this->pass)])
                ->first();
        return $result;
    }

    public function getUserToken(){
        $result =
            DB::table('users')
                ->select('users.*', 'verify_users.token')
                ->join('verify_users', 'users.id', '=', 'verify_users.user_id')
                ->where('users.id', $this->id)
                ->first();
        return $result;
    }

    public function saveWithRegularUserRole(){
        $result =
            DB::table('users')
                ->insert([
                    'user' => $this->user,
                    'pass' => md5($this->pass),
                    'role_id' => '1',
                    'name_surname' => $this->name_surname,
                    'email' => $this->email,
                    'phone' => $this->phone,
                //    'created_at' => time(),
                    'verified' => false
                    //
                ]);
        return $result;
    }

    // UPDATE

    public function updateVerifiedStatus(){
        $data = [
            'verified' => true
        ];

        $result =
            DB::table('users')
                ->where('id', $this->id)
                ->update($data);

        return $result;
    }

    public function delete(){
        $result = DB::table('users')
            ->where('id', $this->id)
            ->delete();
        return $result;
    }

}