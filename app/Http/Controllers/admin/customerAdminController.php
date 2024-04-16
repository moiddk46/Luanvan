<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class customerAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new User();
        $this->title = 'Khách hàng | Admin';
    }

    public function getAllCustomer(){
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->listCustomer();
        return view('Pages.Admin.customer.listCustomer', compact('title', 'data'));
    }
}
