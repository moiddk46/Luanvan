<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\order\orderAdminRequest;
use App\Models\orderModel;
use App\Models\ServiceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class orderAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new orderModel();
        $this->title = 'Đơn hàng | Admin';
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
        $message = "Vui lòng chọn đơn hàng và trạng thái để thực hiện cập nhật trạng thái";
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

    public function detailOrder($data)
    {
        $title = 'Chi tiết đơn hàng | Admin';
        $service = $this->service;

        $data = $this->service->selectDetailOrder($data);
        if (empty($data)) {
            $message = "Không có chi tiết đơn hàng";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $staff = new User();
        $listStaff = $staff->getAllStaffAssign();
        $status = $this->service->getStatus();
        $statusReceipt = $this->service->getStatusReceipt();

        return view('Pages.Admin.order.DetailOrder', compact('title', 'data', 'listStaff', 'status', 'statusReceipt'));
    }

    public function updateDetailOrder(Request $request)
    {
        $formData = $request->all();
        $idUser = $formData['idUser'];
        $orderId = $formData['orderId'];
        $status = $formData['status'];
        $statusReceipt = $formData['statusReceipt'];
        $staff = $formData['staff'];
        $page = $formData['page'];

        $count = $this->service->updateDetail($orderId, $status, $staff, $statusReceipt, $idUser, $page);
        $message = "Thông tin đơn hàng không có thay đổi";
        if ($count > 0) {
            $message = "Bạn đã cập nhật thông tin đơn hàng thành công";
            return redirect()->route('orderAdmin')->with([
                'message' => $message,
                'status' => true
            ]);
        }
        return redirect()->back()->with([
            'message' => $message,
            'status' => false
        ]);
    }

    public function getDownload($data)
    {

        $data = $this->service->selectDetailOrder($data);
        $fileName = '';
        $taskId = '';
        foreach ($data as $row) {
            $fileName = $row->order_file_name;
            $taskId = $row->order_id;
        }
        $path = config('app.pathFileOrder') . '/' . $taskId . '/' . $fileName;
        $headers = array(
            'Content-Type' => 'application/octet-stream'
        );
        $exists = Storage::disk('public')->exists($path);
        if ($exists) {
            return response()->download(storage_path('app/public/' . $path), $fileName, $headers);
        } else {
            // Nếu tệp không tồn tại, xử lý tương ứng (ví dụ: trả về thông báo lỗi)
            $message = "Không thể download file";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
    }

    public function addOrder()
    {
        $title = "Thêm đơn hàng";

        $service = new ServiceModel();
        $serviceType = $service->getServiceType();

        $statusReceipt = $this->service->getStatusMethod();

        $priceService = $service->getPriceService();

        return view('Pages.Admin.order.addOrder', compact('title', 'serviceType', 'statusReceipt', 'priceService'));
    }

}
