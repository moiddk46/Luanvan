<?php

namespace App\Models;

use App\Const\KCconst;
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

    public function searchTask($key, $idUser)
    {

        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $idUser)
            ->where('st.service_type_name', 'LIKE', $key . '%')
            ->orWhere('om.order_id', $key)
            ->select('am.*', 'om.*', 'od.*', 'sm.*', 'st.*')
            ->get()->toArray();

        return $select;
    }
    public function getTaskDoNot()
    {
        $user = Auth::user();
        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $user->id)
            ->whereNot('am.status', KCconst::DB_STATUS_ORDER_FINISHED)
            ->select('am.*', 'om.*', 'od.*', 'sm.*', 'st.*')
            ->paginate(10);

        return $select;
    }

    public function getTaskDone()
    {
        $user = Auth::user();
        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $user->id)
            ->where('am.status', KCconst::DB_STATUS_ORDER_FINISHED)
            ->select('am.*', 'om.*', 'od.*', 'sm.*', 'st.*')
            ->paginate(10);

        return $select;
    }

    public function countTaskDone($idUser)
    {
        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $idUser)
            ->where('am.status', KCconst::DB_STATUS_ORDER_FINISHED)
            ->count();

        return $select;
    }

    public function countTaskStaff($idUser)
    {
        $select = DB::table('laravel.assign_master as am')
            ->join('laravel.order_master as om', 'om.order_id', '=', 'am.order_id')
            ->join('laravel.order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('laravel.status_master as sm', 'sm.status_id', '=', 'am.status')
            ->join('laravel.service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->where('am.staff_id', $idUser)
            ->count();

        return $select;
    }

    public function detailTask($data)
    {
        $select = DB::table('order_detail as od')
            ->select('od.*', 'om.*', 'st.*', 'sm.*', 'am.staff_id', 'us.id', 'us.name as nameStaff', 'sr.status_id as sr_status_id', 'sr.status as sr_status', 'sd.status_id as sd_status_id', 'sd.status as sd_status')
            ->join('service_type as st', 'st.service_type_code', '=', 'od.service_type_code')
            ->join('order_master as om', 'om.order_id', '=', 'od.order_id')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
            ->join('receipts as re', 're.id_order', '=', 'od.order_id')
            ->join('status_receipt as sr', 'sr.status_id', '=', 're.status')
            ->join('status_method as sd', 'sd.status_id', '=', 're.method')
            ->leftJoin('assign_master as am', function ($join) {
                $join->on('am.order_id', '=', 'od.order_id'); // Thay some_column bằng cột cần join
            })
            ->leftJoin('users as us', function ($join) {
                $join->on('am.staff_id', '=', 'us.id'); // Thay some_column bằng cột cần join
            })
            ->where('od.order_id', '=', $data)
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getStatus(): array
    {
        $select  = DB::table('status_master')
            ->get()->toArray();
        return $select;
    }
    public function updateStatus($orderId, $status)
    {
        $user = Auth::user();
        $count = 0;

        DB::beginTransaction();
        $update1  = DB::table('order_master')
            ->where('order_id', '=', $orderId)
            ->update([
                'status' => $status
            ]);
        if ($update1 > 0) {
            $update2 = DB::table('assign_master as am')
                ->where('am.order_id', '=', $orderId)
                ->where('am.staff_id', $user->id)
                ->update([
                    'am.status' => $status
                ]);
            if ($update2 > 0) {
                $count++;
                DB::commit();
            } else {
                DB::rollBack();
            }
        } else {
            DB::rollBack();
        }

        return $count;
    }

    public function taskComplete()
    {
        $count = DB::table('assign_master')
            ->where('status', KCconst::DB_STATUS_ORDER_FINISHED)
            ->distinct()
            ->count('staff_id');
        return $count;
    }
}
