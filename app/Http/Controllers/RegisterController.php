<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    private $data = [];

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // ************************** -- RULES -- ***************************

        $rules = [
            'tbEmail' => 'required|email|unique:users,email',
            'tbUser' => 'required|alpha_num|unique:users,user',
            'tbPass' => 'required|min:6',
            'tbPassConfirm' => 'required|same:tbPass',
            'tbNameSurname' => 'required|min:3',
            'tbPhone' => 'required|regex:/^[0-9]*$/'
        ];

        // ************************** -- MESSAGES -- ***************************

        $messages = [
            'required' => 'Polje :attribute je obavezno',
            'same' => 'Ponovljena lozinka nije ista kao i lozinka',
            'regex' => ':attribute nije u dozvoljenom formatu',
            'email' => 'Email nije u dobrom formatu',
            'tbPhone.regex' => 'Broj telefona mora biti zapisan brojevima i ne sme sadržati slova',
            'tbUser.regex' => 'Korisničko ime mora početi malim slovom, i ne sme imati razmake',
            'tbNameSurname.min' => 'Ime nije u ispravnom formatu',
            'min' => ':attribute mora imati minimum :min karaktera',
            'unique' => ':attribute je već iskorišćen/a'
        ];

        $this->validate($request, $rules, $messages);

        $email = $request->get('tbEmail');
        $username = $request->get('tbUser');
        $pass = $request->get('tbPass');
        $passConfirm = $request->get('tbPassConfirm');
        $nameSurname = $request->get('tbNameSurname');
        $phone = $request->get('tbPhone');

        try{
            $user = new User();
            $user->email = $email;
            $user->pass = $pass;
            $user->user = $username;
            $user->name_surname = $nameSurname;
            $user->phone = $phone;

            $result = $user->saveWithRegularUserRole();

            $verify_user = new VerifyUser();
            $result_for_id = $user->getByUserAndPass();
            $verify_user->user_id = $result_for_id->id;
            $verify_user->token = str_random(40);
            $user->token = $verify_user->token;
            $verify_user->create();

            Mail::to($user->email)->send(new VerifyMail($user));

         /*   Mail::send('emails.verifyUser', ['name' => 'Novica'], function($message){
                $message->('misteryx96@yahoo.com', 'Ja')->subject('Welcome');
            });  */

            if($result == 1){
                return redirect()->route('index')->with('success', 'Uspešno ste se registrovali');}
            else{
                return redirect()->route('index')->with('error', 'Neuspeh pri registraciji, molimo pokušajte opet!');}
        }
        catch (\Exception $exception){
            \Log::error('Error: ' . $exception->getMessage());
            return redirect('/')->with('error', 'Greška pri radu aplikacije, molimo pokušajte ponovo!');
        }

    }

    public function verifyUser($token){

        $verifyUser = new VerifyUser();
        //$verifyUser = VerifyUser::where('token, $token')->first();
        $verifyUser->token = $token;
        $verifyUser->getByToken();
        $user = new User();
        $user->id = $verifyUser->user_id;
        $user->get();

        if(isset($verifyUser)){
            if(!$user->verified){
                $user->updateVerifiedStatus();
                $status = "Uspešno ste verifikovali e-mail adresu. Sada se možete ulogovati";
            } else{
                $status = "Već ste se verifikovali.";
            }
        } else{
            return redirect('/')->with('error', "Vaš e-mail ne postoji");
        }

        return redirect('/')->with('status', $status);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
