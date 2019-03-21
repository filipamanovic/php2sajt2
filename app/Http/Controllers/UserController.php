<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }

    public function registerView(){
        return view('front.pages.register');
    }

    public function register(RegistrationRequest $request){
        $token = md5(time().rand().$request->email);
        $ime = $request->ime;
        $prezime = $request->prezime;
        $email = $request->email;
        $pass = $request->pass;
        $tel = $request->tel;
        $grad = $request->city;
        $this->userModel->registration($ime, $prezime, $email, $pass, $tel, $grad, $token);
        $data = array('name' => $ime, 'body' => 'http://localhost:8000/verifyEmail/'.$token);
        try {
            Mail::send('front.pages.email', $data, function ($message) use ($ime, $email) {
                $message->to($email, $ime)
                    ->subject('PC and Equipment Site');
                $message->from('php2sajt2@gmail.com', 'Account verification');
            });
            return response()->json(['data' => 'Successful registration, please activate an account on your email.']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function verifyEmail($token){
        $user = $this->userModel->verifyAcc($token);
        session()->put('user', $user);
        return redirect('/');
    }

    public function login(Request $request){
        $user = $this->userModel->login($request->input('emailLog'), $request->input('passLog'));
        if($user == null):
            session()->put('noUser', 'There is no user with provided data, or account is not activated!');
        endif;
        session()->put('user', $user);
        $url = url()->previous();
        if( strpos($url, 'register') && $user != null):
            return redirect('/');
        else:
            return redirect()->back();
        endif;
    }
}
