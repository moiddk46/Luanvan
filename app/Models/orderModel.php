<?php

namespace App\Models;

use App\Const\KCconst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

class orderModel extends Model
{
    use HasFactory;

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getAllOrder(): array
    {
        $select  = DB::table('order_master as om')
            ->join('service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
            ->get()->toArray();
        return $select;
    }


    /**
     * Undocumented function
     *
     * @return array
     */
    public function getAllOrderUser(): array
    {
        $user = Auth::user();
        $select  = DB::table('order_master as om')
            ->join('service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
            ->where('id_user', $user->id)
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function countAllOrderUser(): int
    {
        $user = Auth::user();
        $select = 0;
        if (isset($user->id)) {
            $select  = DB::table('order_master as om')
                ->join('service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
                ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
                ->where('id_user', $user->id)
                ->count();
        }
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


    /**
     * @return int
     */
    public function updateStatus($orderId, $status): int
    {
        $update  = DB::table('order_master')
            ->where('order_id', '=', $orderId)
            ->update([
                'status' => $status
            ]);
        $select = DB::table('order_master as om')
            ->join('assign_master as am', 'am.order_id', '=', 'om.order_id')
            ->where('om.order_id', '=', $orderId)
            ->count();
        if ($select > 0) {
            $update  = DB::table('assign_master')
                ->where('order_id', '=', $orderId)
                ->update([
                    'status' => $status
                ]);
        }
        return $update;
    }

    /**
     * @return int
     */
    public function updateDetail($orderId, $status, $staff): int
    {
        $count  = DB::table('order_master')
            ->where('order_id', '=', $orderId)
            ->update([
                'status' => $status
            ]);
        $select = DB::table('order_master as om')
            ->join('assign_master as am', 'am.order_id', '=', 'om.order_id')
            ->where('om.order_id', '=', $orderId)
            ->count();
        if ($select > 0) {
            $count  = DB::table('assign_master')
                ->where('order_id', '=', $orderId)
                ->update([
                    'status' => $status
                ]);
        } else {
            if (isset($staff)) {
                $count = DB::table('assign_master')->insert([
                    'staff_id' => $staff,
                    'order_id' => $orderId,
                    'status' => $status
                ]);
            }
        }
        return $count;
    }

    /**
     * 
     * @return int
     */
    public function insertOrder($formData): int
    {
        $nowDate = Carbon::now()->toDateString();
        $count = 0;

        DB::beginTransaction();
        $orderId = DB::table('order_master')->insertGetId([
            'order_date' => $nowDate,
            'name' => $formData['name'],
            'address' => $formData['address'],
            'phone' => $formData['sdt'],
            'id_user' => $formData['idUser'],
            'service_type_code' => $formData['serviceTypeCode'],
            'status' => KCconst::DB_STATUS_ORDER_HANDLING
        ]);

        if ($orderId > 0) {
            $select  = DB::table('price_request as pr')
                ->join('service_type as st', 'st.service_type_code', '=', 'pr.service_type_code')
                ->join('users as us', 'us.id', '=', 'pr.id_user')
                ->join('status_master as sm', 'sm.status_id', '=', 'pr.status')
                ->where('pr.request_id', $formData['requestId'])
                ->first();
            if (!empty($select)) {
                $pathPriceRequest = config('app.pathFilePriceRequest') . '/' . $select->request_id . '/' . $select->request_file;
                $pathOrder = config('app.pathFileOrder') . '/' . $orderId . '/' . $select->request_file;
                if (!Storage::disk('public')->exists($pathOrder)) {
                    // Nếu không tồn tại, tạo thư mục đíchs
                    Storage::disk('public')->makeDirectory(dirname($pathOrder), 777, true, true);
                }
                $copyFile = Storage::disk('public')->put($pathOrder, $pathPriceRequest);
                if ($copyFile) {
                    $price= $formData['price'] * $formData['quantity'];
                    $inserted = DB::table('order_detail')->insert([
                        'order_id' => $orderId,
                        'service_type_code' => $formData['serviceTypeCode'],
                        'quantity' => $formData['quantity'],
                        'unit_price' => $formData['price'],
                        'order_file_name' => $price
                    ]);
                    if ($inserted > 0) {
                        $count++;
                    }
                }
            }
        }

        if ($count < 0) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $count;
    }


    /**
     * @return stdClass
     */
    public function selectPrice($serviceTypeCode): stdClass
    {
        $select = DB::table('price_service_type')
            ->where('service_type_code', $serviceTypeCode)
            ->first();
        return $select;
    }



    /**
     * @return array
     */
    public function selectDetailOrder($data): array
    {

        $select = DB::table('order_detail as od')
            ->select('od.*', 'ps.*', 'om.*', 'st.*', 'sm.*', 'am.staff_id', 'us.id', 'us.name as nameStaff')
            ->join('price_service_type as ps', 'od.service_type_code', '=', 'ps.service_type_code')
            ->join('service_type as st', 'st.service_type_code', '=', 'od.service_type_code')
            ->join('order_master as om', 'om.order_id', '=', 'od.order_id')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
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
}
