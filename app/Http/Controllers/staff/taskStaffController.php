<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\taskStaffModel;
use Illuminate\Http\Request;

class taskStaffController extends Controller
{
    public $service;
    public $title;
    public function __construct()
    {
        $this->service= new taskStaffModel();
        $this->title = 'Nhiệm vụ';
    }

    public function index(){
        $title = $this->title;
        $data= $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }

    public function detailTask(string $data){
        $title = $this->title;
        $data= $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }

    public function updateTask(string $data){
        $title = $this->title;
        $data= $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }
}
