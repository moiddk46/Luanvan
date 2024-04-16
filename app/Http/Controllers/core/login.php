<?php

namespace App\Http\Controllers\core;

use App\Http\Controllers\Controller;
use App\Http\Requests\core\loginRequest;
use App\Models\ServiceMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new ServiceMaster();
        $this->title = 'Login';
    }

    public function login()
    {
        $title = $this->title;

        return view('Pages.core.login', compact('title'));
    }

    public function checkLogin(loginRequest $request)
    {
        $login = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        $messageLogin = "Bạn đã đăng nhập thành công";
        $messageFails = "Tài khoản hoặc mật khẩu không đúng";
        if (Auth::attempt($login)) {
            $user = Auth::user();
            if ($user->position == 3) {
                return redirect()->route('index')->with([
                    'message' => $messageLogin,
                    'status' => true
                ]);
            } else if ($user->position == 1) {
                return redirect()->route('indexAdmin')->with([
                    'message' => $messageLogin,
                    'status' => true
                ]);
            }
            else if($user->position == 2){
                return redirect()->route('indexStaff')->with([
                    'message' => $messageLogin,
                    'status' => true
                ]);
            }
        }
        return redirect()->back()->with([
            'message' => $messageFails,
            'status' => false
        ]);
    }

    public function logout()
    {
        $messageLogout = "Bạn đã đăng xuất tài khoản thành công";
        $messageLogutFail = "Bạn chưa đăng nhập tài khoản";
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('index')->with([
                'message' => $messageLogout,
                'status' => false
            ]);
        }
        return redirect()->route('index')->with([
            'message' => $messageLogutFail,
            'status' => false
        ]);
    }
}
