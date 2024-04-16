<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class serviceAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->title = 'Dịch vụ | Admin';
    }

    public function getAllService(){
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->getAllService();
        return view('Pages.Admin.services.serviceHome', compact('title', 'data'));
    }
}
