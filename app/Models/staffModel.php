<?php

namespace App\Models;

use App\Const\KCconst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class staffModel extends Model
{
    use HasFactory;


    /**
     * 
     */
    public function getAllStaff()
    {

        $select = DB::table('users')
        ->where('position', '=', KCconst::DB_POSITION_STAFF)
        ->paginate(10);
        return $select;
    }
}
