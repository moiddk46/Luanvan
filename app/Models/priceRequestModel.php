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

        $count = DB::table('price_request')->insertGetId([
            'request_date' => $nowDate,
            'request_comment' => $formData['content'],
            'service_type_code' => $formData['serviceTypeCode'],
            'id_user' => $user->id,
            'name' => $formData['name'],
            'address' =>  $formData['address'],
            'phone' =>  $formData['sdt'],
            'request_file' =>  $fileName,
            'status' => KCconst::DB_STATUS_DONT_REPLY
        ]);


        $path = config('app.pathFilePriceRequest') . '/' . $count;
        $file = $formData['files']->storeAs($path, $fileName, 'public');
        if (Storage::disk('public')->exists($file)) {
            $upload = true;
            DB::commit();
        } else {
            DB::rollback();
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
            ->join('status_master as sm', 'sm.status_id', '=', 'pr.status')
            ->where('id_user', $user->id)
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getAllPriceRequestAdmin(): array
    {
        $select  = DB::table('price_request as pr')
            ->join('service_type as st', 'st.service_type_code', '=', 'pr.service_type_code')
            ->join('users as us', 'us.id', '=', 'pr.id_user')
            ->join('status_master as sm', 'sm.status_id', '=', 'pr.status')
            ->get()->toArray();
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
            ->join('status_master as sm', 'sm.status_id', '=', 'pr.status')
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
        $select  = DB::table('status_master')
            ->where('status_id', KCconst::DB_STATUS_DONT_REPLY)
            ->orWhere('status_id', KCconst::DB_STATUS_REPLY)
            ->get()->toArray();
        return $select;
    }

    /**
     * @return int
     */
    public function updateDetailRequest($formData): int
    {
        $count  = DB::table('price_request')
            ->where('request_id', '=', $formData['requestId'])
            ->update([
                'price' => $formData['price'],
                'status' => $formData['status'],
                'price_letter' => $formData['content'],
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
}
