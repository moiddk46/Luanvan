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
     * @return array
     */
    public function getAllStaff(): array
    {

        $select = DB::table('users')
        ->where('position', '=', KCconst::DB_POSITION_STAFF)
        ->get()->toArray();
        return $select;
    }
}
