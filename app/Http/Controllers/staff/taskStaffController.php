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
    public function index()
    {
        $title = $this->title;
        $data = $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }

    public function detailTask(string $data)
    {
        $title = $this->title;
        $data = $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }

    public function updateTask(string $data)
    {
        $title = $this->title;
        $data = $this->service->getTask();
        return view('Pages.Staff.Task', compact('title', 'data'));
    }
}
