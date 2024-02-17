<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceMaster extends Model
{
    use HasFactory;
    /**
     * Undocumented function
     *
     * @return array
     */
    public function getServiceMaster(): array
    {
        $select = DB::table('service_master')
            ->select(
                'service_code',
                'service_name'
            )
            ->get()->toArray();
        // dd($select);
        return $select;
    }
}
