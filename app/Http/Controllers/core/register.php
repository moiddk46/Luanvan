<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Http\Requests\core\RegisterRequest;
use App\Models\ServiceMaster;
use App\Models\User;
use Exception;

class register extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceMaster();
        $this->title = 'Register';
    }

    public function register()
    {
        $title = $this->title;

        return view('Pages.core.register', compact('title'));
    }
    public function registerCreate(RegisterRequest $request)
    {
        try {
            User::create($request->all());
            $messageRegist = "Bạn đã đăng ký tài khoản thành công";
            return redirect()->route('login')->with([
                'message' => $messageRegist,
                'status' => true
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->with('message', $message);
        }

        return redirect('/login');
    }
}
