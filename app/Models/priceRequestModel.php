<?php

namespace App\Models;

use App\Const\KCconst;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class priceRequestModel extends Model
{
    use HasFactory;

    /**
     * 
     * @return boolean
     */
    public function insertRequest($formData): bool
    {
        $user = Auth::user();
        $nowDate = Carbon::now()->toDateString();
        $upload = false;
        DB::beginTransaction();

        $fileName = $formData['files']->getClientOriginalName();

        $statusName = $this->getStatusName(KCconst::DB_STATUS_DONT_REPLY);
        $count = DB::table('price_request')->insertGetId([
            'request_date' => $nowDate,
            'request_comment' => $formData['content'],
            'service_type_code' => $formData['serviceTypeCode'],
            'id_user' => $user->id,
            'name' => $formData['name'],
            'address' =>  $formData['address'],
            'phone' =>  $formData['sdt'],
            'request_file' =>  $fileName,
            'status' => KCconst::DB_STATUS_DONT_REPLY,
            'complete_time' => NULL,
            'page' => $formData['page']
        ]);
        DB::table('notice')
            ->insert(
                [
                    'type_id' => $count,
                    'detail' => 'Yêu cầu báo giá có mã ' . $count . ' của bạn đang ở trạng thái ' . $statusName->status,
                    'id_user' => $user->id,
                    'flash_order' => '0',
                ]
            );


        if (!isset($count) || empty($count)) {
            DB::rollback();
        } else {
            $path = config('app.pathFilePriceRequest') . '/' . $count;
            $file = $formData['files']->storeAs($path, $fileName, 'public');
            if (Storage::disk('public')->exists($file)) {
                $upload = true;
                DB::commit();
            } else {
                DB::rollback();
            }
        }
        return $upload;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getAllPriceRequest(): array
    {
        $user = Auth::user();
        $select  = DB::table('price_request as pr')
            ->join('service_type as st', 'st.service_type_code', '=', 'pr.service_type_code')
            ->join('users as us', 'us.id', '=', 'pr.id_user')
            ->join('status_reply as sm', 'sm.status_id', '=', 'pr.status')
            ->where('id_user', $user->id)
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     *
     */
    public function getAllPriceRequestAdmin()
    {
        $select  = DB::table('price_request as pr')
            ->join('service_type as st', 'st.service_type_code', '=', 'pr.service_type_code')
            ->join('users as us', 'us.id', '=', 'pr.id_user')
            ->join('status_reply as sm', 'sm.status_id', '=', 'pr.status')
            ->paginate(10);
        return $select;
    }

    /**
     * @return array
     */
    public function getDetailPriceRequest($data): array
    {

        $select  = DB::table('price_request as pr')
            ->join('service_type as st', 'st.service_type_code', '=', 'pr.service_type_code')
            ->join('users as us', 'us.id', '=', 'pr.id_user')
            ->join('status_reply as sm', 'sm.status_id', '=', 'pr.status')
            ->where('pr.request_id', $data)
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
        $select  = DB::table('status_reply')
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
     * Undocumented function
     *
     * @return array
     */
    public function getStatusMethod(): array
    {
        $select  = DB::table('status_method')
            ->get()->toArray();
        return $select;
    }

    public function getStatusName($status)
    {
        $select = DB::table('status_reply')
            ->where('status_id', $status)
            ->first();
        return $select;
    }

    /**
     * @return int
     */
    public function updateDetailRequest($formData): int
    {
        $statusName = $this->getStatusName($formData['status']);
        DB::table('notice')
            ->where('type_id',  $formData['requestId'])
            ->where('id_user', $formData['idUser'])
            ->where('flash_order', '0')
            ->update(
                [
                    'detail' => 'Yêu cầu báo giá có mã ' . $formData['requestId'] . ' của bạn đang ở trạng thái ' . $statusName->status,
                    'click' => '0'
                ]
            );
        $count  = DB::table('price_request')
            ->where('request_id', '=', $formData['requestId'])
            ->update([
                'price' => $formData['price'],
                'status' => $formData['status'],
                'price_letter' => $formData['content'],
                'complete_time' => $formData['completeTime'],
                'page' => $formData['page'],
                'check_page' => '1'
            ]);
        return $count;
    }

    /**
     * Undocumented function
     *
     * @return int
     */
    public function countAllPriceRequestUser(): int
    {
        $user = Auth::user();
        $select = 0;
        if (isset($user->id)) {
            $select  = DB::table('price_request')
                ->where('id_user', $user->id)
                ->count();
        }
        return $select;
    }


    public function deletePriceRequest($data)
    {
        $delete = 0;
        DB::beginTransaction();
        $count = DB::table('price_request')->where('request_id', $data)->count();

        if ($count > 0) {
            $delete = DB::table('price_request')
                ->where('request_id', $data)
                ->delete();
            DB::commit();
            $delete++;
            return $delete;
        } else {
            DB::rollBack();
            return $delete;
        }
    }
}
