<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminCommentModel extends Model
{
    public function getAll(){
        return DB::table('komentar')
            ->join('korisnik', 'komentar.korisnik_id', '=', 'korisnik.id')
            ->join('proizvod', 'komentar.proizvod_id', '=', 'proizvod.id')
            ->select('komentar.*', 'korisnik.*', 'proizvod.*', 'komentar.id as k_id')
            ->orderBy('komentar.proizvod_id')
            ->paginate(6);
    }

    public function insert($text, $product_id, $user_id){
        return DB::table('komentar')
            ->insert([
               'text' => $text,
                'datum' => time(),
                'proizvod_id' => $product_id,
                'korisnik_id' => $user_id
            ]);
    }

    public function getSingleComment($comment_id){
        return DB::table('komentar')
            ->where('id', '=', $comment_id)
            ->first();
    }

    public  function updateComment($text, $user_id, $product_id, $comment_id){
        return DB::table('komentar')
            ->where('id', '=', $comment_id)
            ->update([
                'text' => $text,
                'proizvod_id' => $product_id,
                'korisnik_id' => $user_id
            ]);
    }

    public function deleteComment($comment_id){
        return DB::table('komentar')
            ->where('id', '=', $comment_id)
            ->delete();
    }
}
