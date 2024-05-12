<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ratingModel extends Model
{
    use HasFactory;

    public function rating($data)
    {
        $select = DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->get()->toArray();
        return $select;
    }

    public function ratingService($data)
    {
        $select = DB::table('service_type as st')
            ->where('st.service_code', $data)
            ->join('rating as ra', 'ra.service_type_code', '=', 'st.service_type_code')
            ->first();
        return $select;
    }
    public function ratingServiceDetail($data)
    {
        $select = DB::table('service_type as st')
            ->where('ra.service_type_code', $data)
            ->join('rating as ra', 'ra.service_type_code', '=', 'st.service_type_code')
            ->first();
        return $select;
    }

    public function replyRating($formData)
    {
        $count = DB::table('detail_rating')
            ->where('id_detail', $formData['detailId'])
            ->update([
                'reply_rating' => $formData['ratingReply']
            ]);
        return $count;
    }

    public function listRatingService()
    {
        $select = DB::table('service_type as st')
            ->join('rating as ra', 'ra.service_type_code', '=', 'st.service_type_code')
            ->paginate(10);
        return $select;
    }

    public function displayRating($data)
    {
        $select = DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->get()->toArray();

        return $select;
    }

    public function countRating($data)
    {
        $rating = [];

        $count1 =  DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->where('dr.rate', '1')
            ->count();
        $count2 =  DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->where('dr.rate', '2')
            ->count();
        $count3 =  DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->where('dr.rate', '3')
            ->count();
        $count4 =  DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->where('dr.rate', '4')
            ->count();
        $count5 =  DB::table('rating as ra')
            ->where('ra.service_type_code', $data)
            ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
            ->join('users as us', 'us.id', '=', 'dr.id_user')
            ->where('dr.rate', '5')
            ->count();
        $rating['count1'] = $count1;
        $rating['count2'] = $count2;
        $rating['count3'] = $count3;
        $rating['count4'] = $count4;
        $rating['count5'] = $count5;
        return $rating;
    }
    public function insertRating($formData)
    {
        $user = Auth::user();
        $count = 0;
        $ratingId = DB::table('rating')->where('service_type_code', $formData['serviceTypeCode'])
            ->first();

        $rating = DB::table('detail_rating')
            ->insertGetId([
                'rating_id' => $ratingId->rating_id,
                'detail_rate' => $formData['detail'],
                'rate' => $formData['starRating'],
                'id_user' => $user->id,
            ]);

        if ($rating > 0) {
            $averageRate = DB::table('rating as ra')
                ->join('detail_rating as dr', 'dr.rating_id', '=', 'ra.rating_id')
                ->join('users as us', 'us.id', '=', 'dr.id_user')
                ->where('ra.service_type_code', $formData['serviceTypeCode'])
                ->avg('dr.rate');
            $averageRate = round($averageRate, 1);
            DB::table('rating')
                ->where('service_type_code', $formData['serviceTypeCode'])
                ->update([
                    'rate' => $averageRate,
                ]);
            $count++;
        }

        return $count;
    }
}
