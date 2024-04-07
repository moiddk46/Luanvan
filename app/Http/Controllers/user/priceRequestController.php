<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\priceRequest;
use App\Models\priceRequestModel;

class priceRequestController extends Controller
{

    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new priceRequestModel();
    }
    public function initPriceRequest(priceRequest $request)
    {
        $formData = $request->all();
        if (empty($formData)) {
            $message = 'Bạn đã yêu cầu báo giá thất bại.Kiểm tra lại';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $count = $this->service->insertRequest($formData);
        if ($count) {
            $message = 'Bạn đã yêu cầu báo giá thành công';
            return redirect()->route('priceRequestUser')->with([
                'message' => $message,
                'status' => true
            ]);
        }
    }

    public function detailPriceRequest($data)
    {
        $title = 'Chi tiết báo giá';
        $service = $this->service;

        $data = $this->service->getDetailPriceRequest($data);
        if (empty($data)) {
            $message = "Không có thể xem trả lời báo giá";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $status = $this->service->getStatus();

        $statusReceipt = $this->service->getStatusMethod();

        return view('Pages.User.priceRequest.priceRequestDetail', compact('title', 'data', 'status', 'statusReceipt'));
    }

    public function listPriceRequest()
    {
        $data  = $this->service->getAllPriceRequest();
        $title = 'Giỏ hàng';
        return view('Pages.User.priceRequest.priceRequest', compact('title', 'data'));
    }
}
