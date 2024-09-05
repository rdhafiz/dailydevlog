<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Repository\UserAuthRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::logout();
        return redirect(route('user.panel.login'));
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

    public function GetProfile(Request $request)
    {
        $rv = UserAuthRepository::GetProfile($request);
        return response()->json($rv, 200);
    }
    public function UpdateProfile(Request $request)
    {
        $rv = UserAuthRepository::UpdateProfile($request);
        return response()->json($rv, 200);
    }
    public function ChangePassword(Request $request)
    {
        $rv = UserAuthRepository::ChangePassword($request);
        return response()->json($rv, 200);
    }
    public function UpdateAvatar(Request $request)
    {
        $rv = UserAuthRepository::UpdateAvatar($request);
        return response()->json($rv, 200);
    }
}
