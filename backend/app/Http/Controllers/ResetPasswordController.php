<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;



use Mail;

use Illuminate\Auth\Notification\ResetPassword;

use App\Mail\ResetPasswordMail;



class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request)
    
    {

       if(!$this->validateEmail($request->email)){

        return $this->failedResponse();

       }

       $this->send($request->email);

       return $this->successResponse();

    }

    public function send($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));

    }

    public function createToken($email){

        $oldToken = DB::table('password_resets')->where('email', $email)->first();
        if($oldToken){
            return $oldToken;
        }

        $token = str_random(60);
        $this->saveToken($token, $email);

        return $token;
    }

    public function saveToken($token, $email){
        DB::table('password_resets')->insert([

            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);
    }

    public function validateEmail($email)
    
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    
    {

        return response()->json([
            'error' => 'Email was not found on our database'
        ], Response::HTTP_NOT_FOUND);

    }
    public function successResponse()
    
    {

        return response()->json([
            'data' => 'Email was sent, please check your inbox'
        ], Response::HTTP_OK);

    }
}