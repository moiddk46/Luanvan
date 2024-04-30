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

    public function sumPricesByMonth($data)
    {
        $sumPricesByMonth = DB::table('receipts')
            ->select(DB::raw('MONTH(receipt_date) as month'), DB::raw('SUM(sum_price) as total_sum_price'))
            ->whereYear('receipt_date', $data)
            ->groupBy(DB::raw('MONTH(receipt_date)'))
            ->orderBy('month')
            ->get()->toArray();
        return $sumPricesByMonth;
    }
}
