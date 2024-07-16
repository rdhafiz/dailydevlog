<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Repository\UserAuthRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function Login(Request $request)
    {
        $rv = UserAuthRepository::Login($request);
        return response()->json($rv, 200);
    }
    public function Registration(Request $request)
    {
        $rv = UserAuthRepository::Registration($request);
        return response()->json($rv, 200);
    }

    public function Logout(Request $request)
    {
        $rv = UserAuthRepository::Logout($request);
        return response()->json($rv, 200);
    }
    public function Forgot(Request $request)
    {
        $rv = UserAuthRepository::Forgot($request);
        return response()->json($rv, 200);
    }
    public function Reset(Request $request)
    {
        $rv = UserAuthRepository::Reset($request);
        return response()->json($rv, 200);
    }


}
