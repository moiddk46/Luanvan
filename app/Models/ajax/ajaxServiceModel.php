<?php

namespace App\Models\ajax;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ajaxServiceModel extends Model
{
    use HasFactory;
    /**
     * Undocumented function
     *
     * @param string servicecode 
     * @return array
     */
    public function getServiceType(string $servicecode): array
    {
        $select = DB::table('service_type')
            ->select(
                'service_type_code',
                'service_type_name'
            )
            ->where('service_code', '=', $servicecode)
            ->get()->toArray();
        // dd($select);
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
}
