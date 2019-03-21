<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    public function login($email, $pass){
        return DB::table('korisnik')
            ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
            ->where([
                'korisnik.email' => $email,
                'korisnik.password' => md5($pass),
                'korisnik.aktivan' => 1
            ])
            ->select('korisnik.*', 'uloga.uloga')
            ->first();
    }

    public function registration($ime, $prezime, $email, $pass, $tel, $grad, $token){
        return DB::table('korisnik')
            ->insert([
                'ime' => $ime,
                'prezime' => $prezime,
                'email' => $email,
                'password' => md5($pass),
                'kontakt' => $tel,
                'grad' => $grad,
                'vremeRegistracije' => time(),
                'aktivan' => 0,
                'token' => $token,
                'uloga_id' => 2
            ]);
    }

    public function verifyAcc($token)
    {
        DB::table('korisnik')
            ->where('korisnik.token', '=', $token)
            ->update([
                'korisnik.aktivan' => 1
            ]);
        return DB::table('korisnik')
            ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
            ->where('korisnik.token', '=', $token)
            ->select('korisnik.*', 'uloga.uloga')
            ->first();
    }
}
