<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use stdClass;

class ServiceModel extends Model
{
    use HasFactory;



    /**
     * Undocumented function
     *
     * 
     */
    public function getAllService()
    {
        $select = DB::table('laravel.service_type as tp')
            ->join('service_master as sm', 'sm.service_code', '=', 'tp.service_code')
            ->join('laravel.service_type_img as tm', 'tm.service_type_code', '=', 'tp.service_type_code')
            ->paginate(10);
        return $select;
    }

    public function getAllServiceSearch()
    {
        $select = DB::table('laravel.service_type as tp')
            ->join('service_master as sm', 'sm.service_code', '=', 'tp.service_code')
            ->join('laravel.service_type_img as tm', 'tm.service_type_code', '=', 'tp.service_type_code')
            ->get()->toArray();
        return $select;
    }
    /**
     * Undocumented function
     *
     * @return stdClass
     */
    public function getServiceName(string $data): stdClass
    {
        $select = DB::table('laravel.service_master')
            ->select(
                'service_name',
            )
            ->where('service_code', '=', $data)
            ->first();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return stdClass
     */
    public function getServiceTypeName(string $data): stdClass
    {
        $select = DB::table('laravel.service_type')
            ->select(
                'service_type_name',
            )
            ->where('service_type_code', '=', $data)
            ->first();
        return $select;
    }
    /**
     * Undocumented function
     *
     * @return array
     */
    public function getServiceList(string $data): array
    {
        $select = DB::table('laravel.service_type as tp')
            ->select(
                'tp.service_type_code',
                'tp.service_type_name',
                'tp.service_type_detail',
                'tm.img',
            )
            ->where('service_code', '=', $data)
            ->join('laravel.service_type_img as tm', 'tm.service_type_code', '=', 'tp.service_type_code')
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return stdClass
     */
    public function getDetailService(string $data): stdClass
    {
        $select = DB::table('laravel.service_type as tp')
            ->select(
                'tp.service_type_code',
                'tp.service_type_name',
                'tp.service_type_detail',
                'pt.price_id',
                'pt.price',
                'pt.detail_price',
                'sm.service_code',
                'ra.*'
            )
            ->where('tp.service_type_code', '=', $data)
            ->join('laravel.price_service_type as pt', 'pt.service_type_code', '=', 'tp.service_type_code')
            ->join('service_master as sm', 'sm.service_code', '=', 'tp.service_code')
            ->join('rating as ra', 'ra.service_type_code', '=', 'tp.service_type_code')
            ->first();
        return $select;
    }


    public function getDetailServiceAdmin(string $data)
    {
        $select = DB::table('laravel.service_type as tp')
            ->where('tp.service_type_code', '=', $data)
            ->join('service_master as sm', 'sm.service_code', '=', 'tp.service_code')
            ->join('laravel.price_service_type as pt', 'pt.service_type_code', '=', 'tp.service_type_code')
            ->join('laravel.service_type_img as tm', 'tm.service_type_code', '=', 'tp.service_type_code')
            ->get()->toArray();
        return $select;
    }

    public function updateDetailService($formData)
    {
        $result = false;
        if (isset($formData)) {
            if (isset($formData['files'])) {
                $fileName = time() . '_' . $formData['files']->getClientOriginalName();
                $formData['files']->move(public_path('assets/images'), $fileName);
                DB::table('service_type_img')
                    ->where('service_type_code', $formData['serviceTypeCode'])
                    ->update([
                        'img' => $fileName
                    ]);
            }
            DB::table('service_type')
                ->where('service_type_code', $formData['serviceTypeCode'])
                ->update([
                    'service_code' => $formData['serviceCode'],
                    'service_type_name' => $formData['serviceTypeName'],
                    'service_type_detail' => $formData['detailService']
                ]);



            DB::table('price_service_type')
                ->where('service_type_code', $formData['serviceTypeCode'])
                ->update([
                    'detail_price' => $formData['detailPrice'],
                    'price' => $formData['price']
                ]);
            $result = true;
        }

        return $result;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function getService(): array
    {
        $select = DB::table('laravel.service_master')
            ->get()->toArray();
        return $select;
    }

    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function checkServiceCode($serviceCode): bool
    {
        $select = DB::table('laravel.service_type')
            ->where('service_type_code', $serviceCode)
            ->count();
        if ($select > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     */
    public function insertService($formData)
    {
        $sum = 0;
        if (!isset($formData)) {
            return $sum;
        }
        DB::beginTransaction();
        try {
            $fileName = time() . '_' . $formData['files']->getClientOriginalName();
            $formData['files']->move(public_path('assets/images'), $fileName);
            DB::table('service_type')
                ->insert([
                    'service_type_code' => $formData['serviceCode'],
                    'service_type_name' => $formData['serviceTypeName'],
                    'service_code' => $formData['serviceName'],
                    'service_type_detail' => $formData['detailService'],

                ]);
            DB::table('rating')
                ->insert([
                    'service_type_code' => $formData['serviceCode'],
                    'rate' => '5'
                ]);
            DB::table('service_type_img')
                ->insert([
                    'service_type_code' => $formData['serviceCode'],
                    'img' => $fileName,

                ]);
            DB::table('price_service_type')
                ->insert([
                    'service_type_code' => $formData['serviceCode'],
                    'price' => $formData['price'],
                    'detail_price' => $formData['detailPrice'],
                ]);
            $sum++;
            DB::commit();
            return $sum;
        } catch (Exception $e) {
            DB::rollBack();
            return $sum;
        };
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

    public function getServiceType()
    {
        $select  = DB::table('service_type')
            ->get()->toArray();
        return $select;
    }

    public function getPriceService()
    {
        $select = DB::table('price_service_type as pt')
            ->join('service_type as st', 'st.service_type_code', '=', 'pt.service_type_code')
            ->get()->toArray();
        return $select;
    }

    public function getPriceServiceWhere($data)
    {
        $select = DB::table('price_service_type as pt')
            ->join('service_type as st', 'st.service_type_code', '=', 'pt.service_type_code')
            ->where('pt.service_type_code', $data)
            ->get()->toArray();
        return $select;
    }

    public function deleteService($data)
    {
        $count = 0;
        $check = DB::table('order_master')
            ->where('service_type_code', $data)
            ->count();
        if ($check < 1) {
            $delete = DB::table('service_type_img')
                ->where('service_type_code', $data)
                ->delete();
            if ($delete > 0) {
                $count++;
            }
            $delete = DB::table('price_service_type')
                ->where('service_type_code', $data)
                ->delete();
            if ($delete > 0) {
                $count++;
            }
            $delete = DB::table('service_type')
                ->where('service_type_code', $data)
                ->delete();
            if ($delete > 0) {
                $count++;
            }
        }
        return $count;
    }

    public function searchService($formData)
    {
        $key = $formData['key'];

        $data = DB::table('service_master as sm')
            ->join('service_type as st', 'st.service_code', '=', 'sm.service_code')
            ->where('service_type_name', 'LIKE', $key . '%')
            ->get()->toArray(); 

        return $data;
    }
}
