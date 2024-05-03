<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\priceRequest;
use App\Models\priceRequestModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class priceRequestAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new priceRequestModel();
        $this->title = 'Báo giá | Admin';
    }
    public function priceRequest()
    {
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->getAllPriceRequestAdmin();
        return view('Pages.Admin.priceRequest.priceRequest', compact('title', 'data'));
    }

    public function priceRequestSearch(Request $request)
    {
        $formData = $request->all();
        $key = $formData['key'];

        $data  = $this->service->getSearchPriceRequestAdmin($key);

        return response()->json($data);
    }

    public function detailPriceRequest($data)
    {
        $title = 'Chi tiết báo giá | Admin';
        $service = $this->service;

        $data = $this->service->getDetailPriceRequest($data);
        if (empty($data)) {
            $message = "Không có thể trả lời báo giá";
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $status = $this->service->getStatus();

        return view('Pages.Admin.priceRequest.priceRequestDetail', compact('title', 'data', 'status'));
    }

    public function getDownload($data)
    {

        $data = $this->service->getDetailPriceRequest($data);
        $fileName = '';
        $requestId = '';
        foreach ($data as $row) {
            $fileName = $row->request_file;
            $requestId = $row->request_id;
        }
        $path = config('app.pathFilePriceRequest') . '/' . $requestId . '/' . $fileName;
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

    public function updateDetailRequest(Request $request)
    {
        $formData = $request->all();

        $count = $this->service->updateDetailRequest($formData);
        $message = "Thực hiện trả lời báo giá không thành công";
        if ($count > 0) {
            $message = "Bạn đã trả lời và cập nhật yêu cầu báo giá thành công";
            return redirect()->route('priceRequestAdmin')->with([
                'message' => $message,
                'status' => true
            ]);
        }
        return redirect()->back()->with([
            'message' => $message,
            'status' => false
        ]);
    }

    public function addPriceRequest()
    {
        $title = 'Thêm yêu cầu báo giá';
        $service = new ServiceModel();
        $serviceType = $service->getServiceType();
        return view('Pages.Admin.priceRequest.addPriceRequest', compact('title', 'serviceType'));
    }
    public function initPriceRequest(priceRequest $request)
    {
        $formData = $request->all();
        if (empty($formData)) {
            $message = 'Bạn đã thêm yêu cầu báo giá thất bại.Kiểm tra lại';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $count = $this->service->insertRequest($formData);
        if ($count) {
            $message = 'Bạn đã yêu cầu báo giá thành công';
            return redirect()->route('priceRequestAdmin')->with([
                'message' => $message,
                'status' => true
            ]);
        }
    }

    public function deletePriceRequest($data)
    {
        $check = $this->service->checkDeletePriceRequest($data);
        if ($check > 0) {
            $message = 'Bạn không thể xóa yêu cầu báo giá đã trả lời';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $delete = $this->service->deletePriceRequest($data);
        if ($delete < 1) {
            $message = 'Bạn đã xóa không thành công yêu cầu báo giá';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
        $message = 'Bạn đã xóa yêu cầu báo giá thành công';
        return redirect()->route('priceRequestAdmin')->with([
            'message' => $message,
            'status' => true
        ]);
    }
}
