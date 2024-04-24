<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\ServiceMaster;
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
        $order = new orderModel();
        $user = new User();
        $countOrder = $order->countOrder();
        $sumPrice = $order->sumPrice();
        $countStaff = $user->countStaff();
        $countCustomer = $user->countCustomer();
        return view('Pages.Admin.Home', compact('title', 'countOrder', 'countStaff', 'countCustomer', 'sumPrice'));
    }
}
