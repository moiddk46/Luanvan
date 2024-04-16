<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
                'tm.img'
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
                'pt.price'
            )
            ->where('tp.service_type_code', '=', $data)
            ->join('laravel.price_service_type as pt', 'pt.service_type_code', '=', 'tp.service_type_code')
            ->first();
        return $select;
    }
}
