<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{
    public function getAllCommentsForProduct($id){
        return DB::table('komentar')
            ->join('korisnik', 'komentar.korisnik_id', '=', 'korisnik.id')
            ->where('komentar.proizvod_id', '=', $id)
            ->get();
    }

    public function insertComment($comment, $user_id, $product_id){
        return DB::table('komentar')
            ->insert([
                'text' => $comment,
                'datum' => time(),
                'proizvod_id' => $product_id,
                'korisnik_id' => $user_id
            ]);
    }
}
