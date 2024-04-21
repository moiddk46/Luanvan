<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class taskStaffModel extends Model
{
    use HasFactory;

    public function getTask()
    {
        $user = Auth::user();
        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $user->id)
            ->select('am.*', 'om.*', 'od.*', 'sm.*', 'st.*')
            ->paginate(10);

        return $select;
    }


    public function detailTask()
    {
    }

    public function updateStatus()
    {
    }
}
