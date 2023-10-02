<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('product management')->accessToken;
            return response()->json([
                "token" => $token
            ]);
        } else {
            return response()->json([
                "message" => "Đăng nhập thất bại"
            ]);
        }
    }

    public function signUp(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user=$request->all();
        $user['password']=Hash::make($request['password']);
        User::create($user);
        return response()->json([
            "status"=>"register successfully",
        ],200);
    }

    public function userDetail(){
        $user=Auth::user();
        return response()->json([
            "data"=>$user
        ]);
    }
}
