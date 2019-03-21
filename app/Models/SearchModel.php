<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SearchModel extends Model
{
    public function getAllCategories(){
        return DB::table('kategorija')->get();
    }

    public function getAllManufacturers(){
        return DB::table('proizvodjac')->get();
    }
}
