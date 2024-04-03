<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Const\KCconst;
use Illuminate\Http\Request;
use App\Models\orderModel;

class orderUserController extends Controller
{

    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new orderModel();
    }

    public function initOrder(Request $request)
    {
        $formData = $request->all();
        if (empty($formData) || empty($formData['quantity'])) {
            $message = 'Bạn đã đặt hàng thất bại.Kiểm tra lại số lượng bản cần.';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $count = $this->service->insertOrder($formData);
        if ($count > 0) {
            $message = 'Bạn đã đặt hàng thành công';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => true
            ]);
        }
    }

    public function listOrder()
    {
        $data  = $this->service->getAllOrderUser();
        $title = 'Giỏ hàng';
        return view('Pages.User.cart.Cart', compact('title', 'data'));
    }
}
