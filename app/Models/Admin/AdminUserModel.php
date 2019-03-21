<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminUserModel extends Model
{
    public function getAll(){
        return DB::table('korisnik')
            ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
            ->select('korisnik.*', 'uloga.uloga')
            ->paginate(6);
    }

    public function getAllForComment(){
        return DB::table('korisnik')
            ->get();
    }

    public function addUser($first_name, $last_name, $email, $pass, $tel, $city, $aktivan, $role_id){
        return DB::table('korisnik')
            ->insert([
                'ime' => $first_name,
                'prezime' => $last_name,
                'email' => $email,
                'password' => md5($pass),
                'kontakt' => $tel,
                'grad' => $city,
                'vremeRegistracije' => time(),
                'aktivan' => $aktivan,
                'token' => 'null',
                'uloga_id' => $role_id
            ]);
    }

    public function getSingleUser($user_id){
        return DB::table('korisnik')
            ->join('uloga', 'korisnik.uloga_id', '=', 'uloga.id')
            ->where('korisnik.id', '=', $user_id)
            ->select('korisnik.*', 'uloga.uloga')
            ->first();
    }

    public function updateUser($first_name, $last_name, $email, $pass, $tel, $city, $aktivan, $role_id, $user_id){
        if($pass == "zika"){
            return DB::table('korisnik')
                ->where('korisnik.id', '=', $user_id)
                ->update([
                    'korisnik.ime' => $first_name,
                    'korisnik.prezime' => $last_name,
                    'korisnik.email' => $email,
                    'korisnik.kontakt' => $tel,
                    'korisnik.grad' => $city,
                    'korisnik.aktivan' => $aktivan,
                    'korisnik.uloga_id' => $role_id
                ]);
        } else {
            return DB::table('korisnik')
                ->where('korisnik.id', '=', $user_id)
                ->update([
                    'korisnik.ime' => $first_name,
                    'korisnik.prezime' => $last_name,
                    'korisnik.email' => $email,
                    'korisnik.kontakt' => $tel,
                    'korisnik.grad' => $city,
                    'korisnik.aktivan' => $aktivan,
                    'korisnik.uloga_id' => $role_id,
                    'korisnik.password' => md5($pass)
                ]);
        }
    }

    public function deleteUser($user_id){
        return DB::table('korisnik')
            ->where('korisnik.id', '=', $user_id)
            ->delete();
    }
}
