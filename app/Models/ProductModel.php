<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock;

class ProductModel extends Model
{
    public function getAllProducts(){
        return DB::table('proizvod')
            ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
            ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
            ->paginate(6);
    }

    public function sortProduct($category_id, $manufacturer_id, $price_min, $price_max){
        if($category_id == "null" && $manufacturer_id == "null") {
            return DB::table('proizvod')
                ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
                ->where([
                    ['proizvod.cena', '>=', $price_min],
                    ['proizvod.cena', '<=', $price_max]
                ])
                ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
                ->paginate(6);
        } else if ($category_id != "null" && $manufacturer_id == "null"){
            return DB::table('proizvod')
                ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
                ->where([
                    ['proizvod.cena', '>=', $price_min],
                    ['proizvod.cena', '<=', $price_max],
                    ['proizvod.kategorija_id', '=', $category_id]
                ])
                ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
                ->paginate(6);
        } else if ($manufacturer_id != "null" && $category_id == "null"){
            return DB::table('proizvod')
                ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
                ->where([
                    ['proizvod.cena', '>=', $price_min],
                    ['proizvod.cena', '<=', $price_max],
                    ['proizvod.proizvodjac_id', '=', $manufacturer_id]
                ])
                ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
                ->paginate(6);
        } else {
            return DB::table('proizvod')
                ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
                ->where([
                    ['proizvod.cena', '>=', $price_min],
                    ['proizvod.cena', '<=', $price_max],
                    ['proizvod.proizvodjac_id', '=', $manufacturer_id],
                    ['proizvod.kategorija_id', '=', $category_id]
                ])
                ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
                ->paginate(6);
        }
    }

    public function getSingleProduct($id){
        return DB::table('proizvod')
            ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
            ->join('korisnik', 'proizvod.korisnik_id', '=', 'korisnik.id')
            ->select('proizvod.*', 'slika.*', 'korisnik.*', 'proizvod.id as p_id')
            ->where('proizvod.id', '=', $id)
            ->first();
    }

    public function getUserProducts($user){
        return DB::table('proizvod')
            ->join('slika', 'proizvod.id', '=', 'slika.proizvod_id')
            ->where('proizvod.korisnik_id', '=', $user)
            ->select('proizvod.*', 'slika.*', 'proizvod.id as p_id')
            ->get();
    }

    public function insert($productName, $productDesc, $productPrice, $user_id, $category_id, $manufacturer_id, $src){
        $product_id = DB::table('proizvod')
            ->insertGetId([
               'naziv' => $productName,
                'opis' => $productDesc,
                'cena' => $productPrice,
                'datum' => time(),
                'korisnik_id' => $user_id,
                'kategorija_id' => $category_id,
                'proizvodjac_id' => $manufacturer_id
            ]);
        return DB::table('slika')
            ->insert([
                'src' => $src,
                'proizvod_id' => $product_id
            ]);
    }

    public function updateProduct($productName, $productDesc, $productPrice, $product_id){
        return DB::table('proizvod')
            ->where('proizvod.id', '=', $product_id)
            ->update([
               'naziv' => $productName,
                'opis' => $productDesc,
                'cena' => $productPrice
            ]);
    }

    public function updateProductSlika($productName, $productDesc, $productPrice, $product_id, $slikaId, $src){
        DB::table('proizvod')
            ->where('proizvod.id', '=', $product_id)
            ->update([
                'naziv' => $productName,
                'opis' => $productDesc,
                'cena' => $productPrice
            ]);
        return DB::table('slika')
            ->where('slika.id', '=', $slikaId)
            ->update([
                'src' => $src
            ]);
    }

    public function deleteProduct($product_id){
        DB::table('slika')
            ->where('slika.proizvod_id', '=', $product_id)
            ->delete();
        return DB::table('proizvod')
            ->where('proizvod.id', '=', $product_id)
            ->delete();
    }

    public function updateViews($product_id){
        return DB::table('proizvod')
            ->where('proizvod.id', '=', $product_id)
            ->increment('proizvod.pregledano', 1);
    }
}
