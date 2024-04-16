<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\staffModel;
use Illuminate\Http\Request;

class staffAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new staffModel();
        $this->title = 'Nhân viên | Admin';
    }

    public function getAllStaff(){
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->getAllStaff();
        return view('Pages.Admin.staff.listStaff', compact('title', 'data'));
    }
}
