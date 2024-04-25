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
     * 
     */
    public function getAllOrder()
    {
        $select  = DB::table('order_master as om')
            ->join('service_type as st', 'st.service_type_code', '=', 'om.service_type_code')
            ->join('status_master as sm', 'sm.status_id', '=', 'om.status')
            ->paginate(10);
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
     * Undocumented function
     *
     * @return array
     */
    public function getStatusReceipt(): array
    {
        $select  = DB::table('status_receipt')
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
    public function updateDetail($orderId, $status, $staff, $statusReceipt): int
    {
        $update  = DB::table('order_master')
            ->where('order_id', '=', $orderId)
            ->update([
                'status' => $status
            ]);
        $update = DB::table('receipts')
            ->where('id_order', $orderId)
            ->update([
                'status' => $statusReceipt,
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
        } else {
            if (isset($staff)) {
                $update = DB::table('assign_master')->insert([
                    'staff_id' => $staff,
                    'order_id' => $orderId,
                    'status' => $status
                ]);
            }
        }
        return $update;
    }

    /**
     * 
     * @return int
     */
    public function insertOrder($formData): int
    {
        $completeTime = $formData['completeTime'];
        $date = Carbon::now();
        $nowDate = Carbon::now()->toDateString();
        $futureDate = $date->addDays($completeTime)->toDateString();
        $count = 0;
        $orderId = '';

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
                ->join('status_reply as sm', 'sm.status_id', '=', 'pr.status')
                ->where('pr.request_id', $formData['requestId'])
                ->first();
            if (!empty($select)) {
                $pathPriceRequest = config('app.pathFilePriceRequest') . '/' . $select->request_id . '/' . $select->request_file;
                $pathOrder = config('app.pathFileOrder') . '/' . $orderId . '/' . $select->request_file;
                if (Storage::disk('public')->exists($pathPriceRequest)) {
                    if (!Storage::disk('public')->exists($pathOrder)) {
                        // Nếu không tồn tại, tạo thư mục đíchs
                        Storage::disk('public')->makeDirectory(dirname($pathOrder), 0775, true, true);
                    }
                }
                $fileContents = Storage::disk('public')->get($pathPriceRequest);
                // Ghi nội dung vào file đích
                $copyFile = Storage::disk('public')->put($pathOrder, $fileContents);
                if ($copyFile) {
                    $inserted = DB::table('order_detail')->insert([
                        'order_id' => $orderId,
                        'service_type_code' => $formData['serviceTypeCode'],
                        'quantity' => $formData['quantity'],
                        'unit_price' => $formData['sum'],
                        'order_file_name' => $select->request_file,
                        'complete_time' => $futureDate
                    ]);
                    if ($inserted > 0) {
                        $count1 = DB::table('receipts')
                            ->insert([
                                'id_order' => $orderId,
                                'id_user' => $formData['idUser'],
                                'sum_price' => $formData['sum'],
                                'status' => ($formData['statusReceipt'] == KCconst::DB_RECEIPT_WHEN_GIVE ? KCconst::DB_DONT_RECEIPT : KCconst::DB_DONE_RECEIPT),
                                'method' => $formData['statusReceipt'],
                                'receipt_date' => $nowDate
                            ]);
                        if ($count1 > 0) {
                            $count++;
                        }
                    }
                }
            }
        }

        if ($count < 0) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $orderId;
    }


    public function updateOrderFail($orderId)
    {
        DB::table('receipts')
            ->where('id_order', $orderId)
            ->update([
                'status' => KCconst::DB_DONT_RECEIPT,
            ]);
    }
    /**
     * 
     * @return int
     */
    public function insertOrderLive($formData): int
    {
        $completeTime = $formData['completeTime'];
        $date = Carbon::now();
        $nowDate = Carbon::now()->toDateString();
        $futureDate = $date->addDays($completeTime)->toDateString();
        $count = 0;
        $orderId = '';

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
            $fileName = $formData['files']->getClientOriginalName();
            $pathOrder = config('app.pathFileOrder') . '/' . $orderId . '/' . $fileName;
            $file = $formData['files']->storeAs($pathOrder, $fileName, 'public');
            if ($file) {
                $inserted = DB::table('order_detail')->insert([
                    'order_id' => $orderId,
                    'service_type_code' => $formData['serviceTypeCode'],
                    'quantity' => $formData['quantity'],
                    'unit_price' => $formData['sum'],
                    'order_file_name' => $fileName,
                    'complete_time' => $futureDate
                ]);
                if ($inserted > 0) {
                    $count1 = DB::table('receipts')
                        ->insert([
                            'id_order' => $orderId,
                            'id_user' => $formData['idUser'],
                            'sum_price' => $formData['sum'],
                            'status' => ($formData['statusReceipt'] == KCconst::DB_RECEIPT_WHEN_GIVE ? KCconst::DB_DONT_RECEIPT : KCconst::DB_DONE_RECEIPT),
                            'method' => $formData['statusReceipt'],
                            'receipt_date' => $nowDate
                        ]);
                    if ($count1 > 0) {
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

        return $orderId;
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
     * @return array
     */
    public function selectDetailOrderUser($data): array
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
     * @return int
     */
    public function updateGiveOrder($data): int
    {

        DB::beginTransaction();
        $update = DB::table('order_master')
            ->where('order_id', '=', $data)
            ->update([
                'give_flag' => '1',
            ]);
        if ($update > 0) {
            $update = DB::table('receipts')
                ->where('id_order', $data)
                ->update([
                    'status' => '2',
                ]);
            if ($update > 0) {
                DB::commit();
            } else {
                DB::rollBack();
            }
        } else {
            DB::rollBack();
        }
        return $update;
    }

    public function sumPrice(): int
    {
        $sum = DB::table('order_detail')->sum('unit_price');
        return $sum;
    }

    public function countOrder(): int
    {
        $count = DB::table('order_master')
            ->count();
        return $count;
    }
}
