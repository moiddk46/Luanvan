<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\orderRequest;
use App\Const\KCconst;
use App\Models\orderModel;

class orderUserController extends Controller
{

    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new orderModel();
    }

    public function initOrder(orderRequest $request)
    {
        $formData = $request->all();
        if (empty($formData)) {
            $message = 'Bạn đã đặt hàng thất bại.Kiểm tra lại';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $count = $this->service->insertOrder($formData['serviceTypeCode'], KCconst::DB_STATUS_ORDER_HANDLING, $formData['name'], $formData['address'], $formData['sdt'], $formData['files']);
        if ($count > 0) {
            $message = 'Bạn đã đặt hàng thành công';
            return redirect()->back()->with([
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
