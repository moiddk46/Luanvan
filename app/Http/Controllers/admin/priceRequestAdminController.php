<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\priceRequestModel;
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
            'Content-Type: application/ocstream',
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
}
