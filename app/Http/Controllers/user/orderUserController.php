<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Const\KCconst;
use App\Http\Requests\priceRequest;
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
        if ($formData['status'] == KCconst::DB_STATUS_DONT_REPLY) {
            $message = 'Bạn không thể đặt hàng với yêu cầu báo giá chưa được trả lời';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        } else if (empty($formData['quantity'])) {
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

    public function orderLive(Request $request)
    {
        $formData = $request->all();
        if ($formData['deliveryOption'] == KCconst::DB_FLASH_OFF) {
            if ($formData['name'] == null || $formData['address'] == null || $formData['sdt'] == null || !isset($formData['files'])) {
                $message = 'Vui lòng điền thông tin nhận hàng và tài liệu';
                return redirect()->back()->with([
                    'message' => $message,
                    'status' => false
                ]);
            }
        }
        $count = $this->service->insertOrderLive($formData);
        if ($count > 0) {
            $message = 'Bạn đã đặt hàng thành công';
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => true
            ]);
        }
    }


    public function detailOrder($data)
    {
        $title = 'Chi tiết đơn hàng';
        $service = $this->service;

        $data = $this->service->selectDetailOrderUser($data);
        if (empty($data)) {
            $message = "Không có chi tiết đơn hàng";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $status = $this->service->getStatus();

        return view('Pages.user.Cart.CartDetail', compact('title', 'data', 'status'));
    }

    public function listOrder()
    {
        $data  = $this->service->getAllOrderUser();
        $title = 'Giỏ hàng';
        return view('Pages.User.cart.Cart', compact('title', 'data'));
    }


    public function giveOrder($data)
    {
        if (isset($data)) {
            $count = $this->service->updateGiveOrder($data);
            if ($count < 1) {
                $message = "Đã có lỗi xảy ra vui lòng thử lại";
                return redirect()->back()->with([
                    'message' => $message,
                    'status' => false
                ]);
            } else {
                $message = "Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi";
                return redirect()->route('cart')->with([
                    'message' => $message,
                    'status' => true
                ]);
            }
        } else {
            $message = "Đã có lỗi xảy ra vui lòng thử lại";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
    }

    public function updateClick($id)
    {
        $this->service->updateClick($id);
        return redirect()->back();
    }
}
