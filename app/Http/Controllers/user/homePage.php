<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ServiceMaster;

class homePage extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceMaster();
        $this->title= 'Home';
    }
    public function header()
    {
        $title = $this->title;
        return view('Pages.User.Home', compact('title'));
    }
}
