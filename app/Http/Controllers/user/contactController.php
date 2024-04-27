<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class contactController extends Controller
{
    public function index()
    {
        $title = 'Liên hệ';

        return view('Pages.User.contact.contact', compact('title'));
    }
}
