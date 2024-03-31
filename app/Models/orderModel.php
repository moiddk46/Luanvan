<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
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
     * 
     * @return int
     */
    public function insertOrder($serviceTypeCode, $status, $name, $address, $phone, $files): int
    {
        $user = Auth::user();
        $nowDate = Carbon::now()->toDateString();
        $count = 0;

        DB::beginTransaction();
        $orderId = DB::table('order_master')->insertGetId([
            'order_date' => $nowDate,
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'id_user' => $user->id,
            'service_type_code' => $serviceTypeCode,
            'status' => $status
        ]);

        if ($orderId > 0) {
            $unitPrice = $this->selectPrice($serviceTypeCode);

            if (!empty($unitPrice)) {
                if (!empty($files)) {
                    $path = config('app.pathFile');

                    foreach ($files as $fileData) {
                        $file = $fileData['file'];
                        $quantity = $fileData['quantity'];

                        if ($file instanceof UploadedFile) {
                            $file->store($path, 'public');
                            $fileName = $file->getClientOriginalName();

                            $inserted = DB::table('order_detail')->insert([
                                'order_id' => $orderId,
                                'service_type_code' => $serviceTypeCode,
                                'quantity' => $quantity,
                                'unit_price' => $unitPrice->price_id,
                                'order_file_name' => $fileName
                            ]);

                            if ($inserted) {
                                $count++;
                            }
                        }
                    }
                }
            }
        }

        if ($count != count($files)) {
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
}
