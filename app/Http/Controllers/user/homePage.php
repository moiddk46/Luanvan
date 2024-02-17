<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ServiceMaster;

class homePage extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new ServiceMaster();
    }
    public function header()
    {
        $data = $this->service->getServiceMaster();
        return view('Layouts.MasterLayout', compact('data'));
    }
}
