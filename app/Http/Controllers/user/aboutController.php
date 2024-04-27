<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class aboutController extends Controller
{
    public function index()
    {
        $title = 'Về chúng tôi';

        return view('Pages.User.about.about', compact('title'));
    }
}
