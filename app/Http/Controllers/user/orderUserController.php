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
            $count = $this->service->insertOrderLive($formData);
            if ($count > 0) {
                $message = 'Bạn đã đặt hàng thành công';
                return redirect()->route('cart')->with([
                    'message' => $message,
                    'status' => true
                ]);
            }
        }
        if (!isset($formData['files'])) {
            $message = 'Vui lòng gửi tài liệu';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
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

    public function comfirmUser(Request $request)
    {
        $formData = $request->all();
        $count = $this->service->comfirmUser($formData);
        if ($count < 1) {
            $message = 'Xác nhận đơn hàng không thành công. Vui lòng thử lại.';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $message = 'Bạn đã xác nhận đơn đặt hàng thành công';
        return redirect()->route('cart')->with([
            'message' => $message,
            'status' => true
        ]);
    }


    public function detailOrder($data)
    {
        $title = 'Chi tiết đơn hàng';
        $service = $this->service;

        $data = $this->service->selectDetailOrderUser($data);
        $statusReceipt = $this->service->getStatusMethod();
        if (empty($data)) {
            $message = "Không có chi tiết đơn hàng";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $status = $this->service->getStatus();

        return view('Pages.user.Cart.CartDetail', compact('title', 'data', 'status', 'statusReceipt'));
    }

    public function listOrder()
    {
        $data  = $this->service->getAllOrderUser();
        $title = 'Giỏ hàng';
        return view('Pages.User.cart.Cart', compact('title', 'data'));
    }


    public function giveOrder(Request $request, $data)
    {
        $formData= $request->all();
        if (isset($data)) {
            $count = $this->service->updateGiveOrder($data);
            if ($count < 1) {
                $message = "Đã có lỗi xảy ra vui lòng thử lại";
                return redirect()->back()->with([
                    'message' => $message,
                    'status' => false
                ]);
            } else {
                $message = "Phản hồi của khách hàng";
                return redirect()->route('ratingUser', ['data'=> $formData['serviceCode'] ])->with([
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

    public function deleteOrder($data)
    {
        $check  = $this->service->checkDeleteOrder($data);
        if ($check < 1) {
            $message = "Bạn chỉ có thể xóa đơn hàng ở trạng thái đang xử lý";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }

        $delete = $this->service->deleteOrderUser($data);
        if ($delete > 0) {
            $message = "Bạn đã xóa đơn hàng thành công";
            return redirect()->route('cart')->with([
                'message' => $message,
                'status' => true
            ]);
        }
        $message = "Đã có lỗi xảy ra khi xóa đơn hàng này.";
        return redirect()->back()->with([
            'message' => $message,
            'status' => false
        ]);
    }
}
