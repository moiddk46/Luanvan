<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user\ServiceModel;
use Psy\CodeCleaner\FunctionContextPass;


class servicePage extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceModel();
        $this->title = 'Service';
    }

    public function initService()
    {
        $title = $this->title;
        return view('Pages.User.Service', compact('title'));
    }
}
