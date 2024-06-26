<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ratingModel;
use Illuminate\Http\Request;

class ratingAdminController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new ratingModel();
    }

    public function listRating()
    {
        $title = 'Đánh giá | Admin';
        $data = $this->service->listRatingService();

        return view('Pages.Admin.rating.rating', compact('title', 'data'));
    }

    public function detailRating($data)
    {
        $title = 'Chi tiết đánh giá | Admin';
        $detailService = $this->service->ratingServiceDetail($data);
        $listRating = $this->service->displayRating($data);
        $countRating = $this->service->countRating($data);
        return view('Pages.Admin.rating.detailRating', compact('title', 'listRating', 'countRating', 'detailService'));
    }

    public function replyRating(Request $request)
    {
        $formData = $request->all();

        if (!isset($formData['ratingReply'])) {
            $message = "Vui lòng trả lời đánh giá";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $data = $this->service->replyRating($formData);
        if ($data > 0) {
            $message = "Trả lời đánh giá thành công";
            return redirect()->back()->with([
                'message' => $message,
                'status' => true
            ]);
        }
        $message = "Đã có lỗi xảy ra. Vui lòng thử lại";
        return redirect()->back()->with([
            'message' => $message,
            'status' => true
        ]);
    }
}
