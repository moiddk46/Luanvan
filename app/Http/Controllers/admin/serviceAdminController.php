<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class serviceAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->title = 'Dịch vụ | Admin';
    }

    public function getAllService()
    {
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->getAllService();
        return view('Pages.Admin.services.serviceHome', compact('title', 'data'));
    }

    public function getDetailService(string $data)
    {
        $title = 'Chi tiết dịch vụ | Admin';
        $data = $this->service->getDetailServiceAdmin($data);
        return view('Pages.Admin.services.detailService', compact('title', 'data'));
    }

    public function updateDetailService(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $formData = $request->all();
        $data = $this->service->updateDetailService($formData);
        if ($data) {
            $message = 'Bạn đã cập nhật thông tin dịch vụ thành công';
            return redirect()->route('allService')->with(
                [
                    'message' => $message,
                    'status' => true,
                ]
            );
        } else {
            $message = 'Bạn đã cập nhật thông tin dịch vụ không thành công';
            return redirect()->route('allService')->with(
                [
                    'message' => $message,
                    'status' => false,
                ]
            );
        }
    }

    public function addService()
    {
        $title = 'Thêm dịch vụ | Admin';
        $data = $this->service->getService();
        return view('Pages.Admin.services.addService', compact('title', 'data'));
    }

    public function insertService(Request $request)
    {
        $formData = $request->all();

        if ($formData['serviceCode'] == null || $formData['serviceTypeName'] == null || $formData['detailService'] == null || $formData['detailPrice'] == null || $formData['price'] == null) {
            $message = 'Vui lòng điền đầy đủ thông tin';
            return redirect()->back()->with(
                [
                    'message' => $message,
                    'status' => false,
                ]
            );
        } else {
            $checkServiceCode = $this->service->checkServiceCode($formData['serviceCode']);
            if ($checkServiceCode) {
                $message = 'Mã dịch vụ đã tồn tại';
                return redirect()->back()->with(
                    [
                        'message' => $message,
                        'status' => false,
                    ]
                );
            } else {
                $insert = $this->service->insertService($formData);
                if ($insert > 0) {
                    $message = 'Dịch vụ đã được thêm thành công';
                    return redirect()->route('allService')->with(
                        [
                            'message' => $message,
                            'status' => true,
                        ]
                    );
                } else {
                    $message = 'Dịch vụ không được thêm thành công';
                    return redirect()->route('allService')->with(
                        [
                            'message' => $message,
                            'status' => false,
                        ]
                    );
                }
            }
        }
    }
}
