<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\ServiceMaster;
use Illuminate\Support\Facades\Auth;

class homeUserController extends Controller
{
    private $service;
    private $order;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceMaster();
        $this->title = 'Home';
        $this->order = new orderModel();
    }
    public function home()
    {
        $title = $this->title;
        $service = $this->service;
        if (Auth::check()) {
            $countOrder = $this->order->countAllOrderUser();
            return view('Pages.User.Home.home', compact('title', 'countOrder'));
        }
        return view('Pages.User.Home.home', compact('title'));
    }
}
