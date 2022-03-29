<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;

class APIController extends Controller
{
    //
    public function getUsers()
    {
        $user = User::get();

        return response()->json(['code'=>200,'message'=>'success', 'data'=> $user]);

    }
    public function addUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'         => 'required',
            'confirm_password' => 'required|same:password' 
        ]);
        if ($validator->fails()) {
            # code...
            return response()->json(['code'=>403,'message'=>'error', 'data'=>$validator->getMessageBag()->first()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->roles = 'user';

        $user->save();
        return response()->json(['code'=>200,'message'=>'success', 'data'=>'Succesfully Added User Data']);


    }
    public function editUsers(Request $request)
    {

        // dd($request->all().'update');
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'password'         => 'required',
            'confirm_password' => 'required|same:password' 
        ]);
        if ($validator->fails()) {
            # code...
            return response()->json(['code'=>403,'message'=>'error', 'data'=>$validator->getMessageBag()->first()]);
        }

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password= Hash::make($request->password);
        $user->roles = 'user';

        $user->save();
        return response()->json(['code'=>200,'message'=>'success', 'data'=>'Succesfully Update User Data']);


    }

    public function updateRole(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'roles' => 'required|in:admin,user',
        ]);
        if ($validator->fails()) {
            # code...
            return response()->json(['code'=>403,'message'=>'error', 'data'=>$validator]);
        }
        $user = User::findOrFail($request->id);
        $user->roles = $request->roles;
        $user->save();
        
        return response()->json(['code'=>200,'message'=>'success', 'data'=>'Succesfully update your roles']);
    }

    public function detailUsers(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json(['code'=>200,'message'=>'success', 'data'=> $user]);

    }
}
