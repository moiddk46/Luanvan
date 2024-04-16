<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeStaffController extends Controller
{
    public $title;
    public function __construct()
    {
        $this->title = 'Trang chủ';
    }

    public function home()
    {
        $title = $this->title;
        return view('Pages.Staff.Home', compact('title'));
    }
}
