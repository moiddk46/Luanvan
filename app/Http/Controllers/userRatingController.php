<?php

namespace App\Http\Controllers;

use App\Models\ratingModel;
use Illuminate\Http\Request;

class userRatingController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new ratingModel();
    }

    public function ratingUser($data)
    {
        $title = 'Đánh giá';
        return view("Pages.User.service.rating", compact('title', 'data'));
    }

    public function rating(Request $request)
    {
        $formData = $request->all();
        if (!isset($formData['starRating'])) {
            $message = 'Vui lòng chọn đánh giá';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $data = $this->service->insertRating($formData);
        if ($data > 0) {
            $message = 'Cảm ơn bạn đã sử dụng dịch vụ';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => true
            ]);
        }
        $message = 'Đã có lỗi xảy ra. Vui lòng thử lại';
        return redirect()->back()->with([
            'message' => $message,
            'status' => false
        ]);
    }
}
