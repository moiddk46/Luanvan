<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\core\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class userAdminController extends Controller
{
    private $service;
    public $title;
    public function __construct()
    {
        $this->service = new User();
        $this->title = 'Người dùng | Admin';
    }

    public function getAllStaff()
    {
        $title = $this->title;
        $service = $this->service;

        $data  = $this->service->getAllStaff();
        return view('Pages.Admin.user.listUser', compact('title', 'data'));
    }

    public function getStaff()
    {
        $data = $this->service->getAllStaff();
        return response()->json($data);
    }

    public function getCustomer()
    {
        $customer = new User();
        $data = $customer->listCustomer();
        return response()->json($data);
    }

    public function getDetailUser($data)
    {
        $title = 'Chi tiết người dùng | Admin';
        $data = $this->service->detailUser($data);
        return view('Pages.Admin.user.detailUser', compact('title', 'data'));
    }
    public function viewAddUser()
    {
        $title = 'Thêm người dùng | Admin';
        return view('Pages.Admin.user.addUser', compact('title'));
    }

    public function addUser(RegisterRequest $request)
    {
        try {
            User::create($request->all());
            $messageRegist = "Bạn đã thêm người dùng mới thành công";
            return redirect()->route('allUser')->with([
                'message' => $messageRegist,
                'status' => true
            ]);
        } catch (Exception $e) {
            $message = 'Bạn đã thêm người dùng mới không thành công';
            return redirect()->back()->with([
                'message' => $message,
                'status' => false
            ]);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $formData = $request->all();
            $user = User::findOrFail($formData['id']);
            $user->name = $formData['username'];
            $user->email =  $formData['email'];
            if ($user->id != $formData['id']) {
                $user->position = $formData['position'];
            }
            $user->updated_at = now();
            $user->save();
            $message = 'Thông tin người dùng đã cập nhật thành công';
            return redirect()->route('allUser')->with(
                [
                    'message' => $message,
                    'status' => true,
                ]
            );
        } catch (Exception $e) {
            $message = 'Thông tin người dùng đã cập nhật không thành công';
            return redirect()->route('allUser')->with(
                [
                    'message' => $message,
                    'status' => false,
                ]
            );
        }
    }
}
