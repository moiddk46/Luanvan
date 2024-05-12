<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\taskStaffModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class taskStaffController extends Controller
{
    public $service;
    public $title;
    public function __construct()
    {
        $this->service = new taskStaffModel();
        $this->title = 'Nhiệm vụ';
    }

    public function doneTask()
    {
        $data = $this->service->getTaskDone();
        return response()->json($data);
    }

    public function doNotTask()
    {
        $data = $this->service->getTaskDoNot();
        return response()->json($data);
    }

    public function allTask()
    {
        $data = $this->service->getTask();
        return response()->json($data);
    }

    public function searchTask(Request $request)
    {
        $formData = $request->all();
        $key = $formData['key'];
        $idUser = $formData['idUser'];
        $data = $this->service->searchTask($key, $idUser);
        return response()->json($data);
    }

    public function countTaskStaff(Request $request)
    {
        $formData = $request->all();
        $idUser = $formData['idUser'];

        $data['countTaskStaff'] = $this->service->countTaskStaff($idUser);
        $data['countTaskDone'] = $this->service->countTaskDone($idUser);
        return response()->json($data);
    }
    public function index()
    {
        $title = $this->title;
        $data = $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }

    public function detailTask(string $data)
    {
        $title = 'Chi tiết nhiệm vụ';
        $data = $this->service->detailTask($data);
        $status = $this->service->getStatus();
        return view('Pages.Staff.TaskDetail', compact('title', 'data', 'status'));
    }

    public function updateTask(Request $request)
    {
        $formData = $request->all();
        $idUser = $formData['idUser'];
        $orderId = $formData['orderId'];
        $status = $formData['status'];

        $count = $this->service->updateStatus($orderId, $status, $idUser);
        $message = "Vui lòng chọn trạng thái để cập nhật";
        if ($count > 0) {
            $message = "Bạn đã cập nhật trạng thái đơn hàng thành công";
            return redirect()->route('task')->with([
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

        $data = $this->service->detailTask($data);
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
