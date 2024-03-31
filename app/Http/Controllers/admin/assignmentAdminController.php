<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\assignmentModel;

class assignmentAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new assignmentModel();
        $this->title = 'Assignment | Admin';
    }
    public function initAssignment()
    {
        $title = $this->title;
        $service = $this->service;

        $data = $this->service->getAllAssignment();
        return view('Pages.Admin.task.assignment', compact('title', 'data'));
    }
}
