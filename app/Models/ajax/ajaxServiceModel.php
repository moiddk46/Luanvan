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
            ->where('service_code', '=', $servicecode )
            ->get()->toArray();
        // dd($select);
        return $select;
    }
}
