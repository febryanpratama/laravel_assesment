<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        $user = User::get();

        return view('admin.role.index', compact(['user']));
    }
}
