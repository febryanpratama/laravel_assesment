<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function indexUser()
    {
        return view('admin.user.index');
    }
}
