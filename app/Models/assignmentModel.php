<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class assignmentModel extends Model
{
    use HasFactory;



    /**
     * Undocumented function
     *
     * @return array
     */
    public function getAllAssignment(): array
    {
        $select  = DB::table('order_master as om')
            ->join('order_detail as od', 'od.order_id', '=', 'om.order_id')
            ->join('service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
            ->select('om.order_id', 'st.service_type_name', 'om.total_price', 'om.order_date', 'sm.status', 'sm.status_id')
            ->get()->toArray();
        return $select;
    }
}
