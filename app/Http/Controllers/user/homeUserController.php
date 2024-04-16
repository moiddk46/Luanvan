<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\orderModel;
use App\Models\ServiceMaster;
use Illuminate\Support\Facades\Auth;

class homeUserController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Trang chủ';
    }
    public function home()
    {
        $title = $this->title;
        return view('Pages.User.Home.home', compact('title'));
    }
}
