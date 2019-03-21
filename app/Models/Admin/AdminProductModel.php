<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminProductModel extends Model
{
    public function getAllForComment(){
        return DB::table('proizvod')
            ->get();
    }

    public function getAllCategories(){
        return DB::table('kategorija')
            ->get();
    }

    public function getAllManufacturers(){
        return DB::table('proizvodjac')
            ->get();
    }

    public function getAll(){
        return DB::table('proizvod')
            ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
            ->join('kategorija', 'proizvod.kategorija_id', '=', 'kategorija.id')
            ->join('proizvodjac', 'proizvod.proizvodjac_id', '=', 'proizvodjac.id')
            ->join('korisnik', 'proizvod.korisnik_id', '=', 'korisnik.id')
            ->select('proizvod.*', 'slika.*', 'kategorija.naziv as kat_naziv', 'proizvodjac.naziv as pro_naziv', 'korisnik.*',
                'kategorija.id as kat_id,', 'proizvodjac.id as pro_id', 'korisnik.id as kor_id','proizvod.id as p_id', 'slika.id as s_id')
            ->orderBy('proizvod.id')
            ->paginate(6);
    }

    public function insertProduct($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $src){
        $product_id = DB::table('proizvod')
            ->insertGetId([
               'naziv' => $product_name,
                'opis' => $product_desc,
                'cena' => $product_price,
                'datum' => time(),
                'pregledano' => $product_checked,
                'korisnik_id' => $user_id,
                'kategorija_id' => $category_id,
                'proizvodjac_id' => $manufacturer_id
            ]);
        return DB::table('slika')
            ->insert([
               'src' => $src,
               'alt' => 'slika 123',
               'proizvod_id' => $product_id
            ]);
    }

    public function getSingleProduct($product_id){
        return DB::table('proizvod')
            ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
            ->where('proizvod.id', '=', $product_id)
            ->select('proizvod.*', 'slika.id as slika_id')
            ->first();
    }

    public function updateProduct1($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $product_id){
        return DB::table('proizvod')
            ->where('id', '=', $product_id)
            ->update([
                'naziv' => $product_name,
                'opis' => $product_desc,
                'cena' => $product_price,
                'pregledano' => $product_checked,
                'korisnik_id' => $user_id,
                'kategorija_id' => $category_id,
                'proizvodjac_id' => $manufacturer_id
            ]);
    }

    public function updateProduct2($product_name, $product_desc, $product_price, $product_checked, $user_id, $category_id, $manufacturer_id, $product_id, $slika_id, $src){
        DB::table('proizvod')
            ->where('id', '=', $product_id)
            ->update([
                'naziv' => $product_name,
                'opis' => $product_desc,
                'cena' => $product_price,
                'pregledano' => $product_checked,
                'korisnik_id' => $user_id,
                'kategorija_id' => $category_id,
                'proizvodjac_id' => $manufacturer_id
            ]);
        DB::table('slika')
            ->insert([
                'src' => $src,
                'alt' => 'slika',
                'proizvod_id' => $product_id
            ]);
        DB::table('slika')
            ->where('id', '=', $slika_id)
            ->delete();
    }

    public function deleteProduct($product_id){
        DB::table('slika')
            ->where('proizvod_id', '=', $product_id)
            ->delete();
        return DB::table('proizvod')
            ->where('id', '=', $product_id)
            ->delete();
    }
}
