<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceMaster;

class homeAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct() {
        $this->service = new ServiceMaster();
        $this->title = 'Trang chủ | Admin';
    }

    public function home(){
        $title = $this->title;
        $service = $this->service;
        return view('Pages.Admin.Home', compact('title'));
     }
}
