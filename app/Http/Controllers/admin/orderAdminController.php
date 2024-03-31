<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\orderAdminRequest;
use App\Models\orderModel;

class orderAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new orderModel();
        $this->title = 'Order | Admin';
    }
    public function order()
    {
        $title = $this->title;
        $service = $this->service;

        $data = $this->service->getAllOrder();

        $status = $this->service->getStatus();
        return view('Pages.Admin.order.order', compact('title', 'data', 'status'));
    }


    public function updateStatus(orderAdminRequest $request)
    {
        $formData = $request->all();
        $updateStatus = 0;
        if (isset($formData['orderIds']) && isset($formData['status'])) {
            foreach ($formData['orderIds'] as $key => $row) {
                $updateStatus += $this->service->updateStatus($row, $formData['status']);
            }
        }
        $message= "Vui lòng chọn đơn hàng và trạng thái để thực hiện cập nhật trạng thái";
        if ($updateStatus > 0) {
            $message = "Bạn đã cập nhật trạng thái của " . $updateStatus . " đơn hàng";
            return redirect()->back()->with([
                'message' => $message,
                'status' => true
            ]);
        }
        return redirect()->back()->with([
            'message' => $message,
            'status' => false
        ]);
    }
}
