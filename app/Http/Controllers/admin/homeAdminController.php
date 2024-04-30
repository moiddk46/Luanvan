<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\ServiceMaster;
use App\Models\taskStaffModel;
use App\Models\User;

class homeAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceMaster();
        $this->title = 'Trang chủ | Admin';
    }

    public function home()
    {
        $title = $this->title;
        $service = $this->service;

        return view('Pages.Admin.Home', compact('title'));
    }

    public function static()
    {
        $order = new orderModel();
        $user = new User();
        $task = new taskStaffModel();
        $data = [];
        $data['countOrder'] = $order->countOrder();
        $data['orderComplete'] = $order->orderComplete();
        $data['receiptComplete'] = $order->receiptComplete();
        $data['userOrder'] = $order->userOrder();
        $data['taskComplete'] = $task->taskComplete();
        $data['sumPrice'] = $order->sumPrice();
        $data['countStaff'] = $user->countStaff();
        $data['countCustomer'] = $user->countCustomer();
        return response()->json($data);
    }
}
