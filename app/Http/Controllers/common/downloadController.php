<?php

namespace App\Http\Controllers\common;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\priceRequestModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class downloadController extends Controller
{
    public function getDownloadPrice($data)
    {
        $price = new priceRequestModel();
        $data = $price->getDetailPriceRequest($data);
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
    public function getDownloadOrder($data)
    {
        $order = new orderModel();
        $data = $order->selectDetailOrder($data);
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
}
