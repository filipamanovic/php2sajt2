<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminRoleModel extends Model
{
    public function getAll(){
        return DB::table('uloga')
            ->get();
    }
}
