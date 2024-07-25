<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class UserPanelController extends BaseController
{
    public function index(Request $request)
    {
        return view('user-panel.home.home');
    }

    public function blogDetails(Request $request)
    {
        return view('user-panel.blog-details.blog-details');
    }

    public function login()
    {
        return view('user-panel.login.login');
    }

    public function forgetPassword()
    {
        return view('user-panel.forget-password.forget-password');
    }

    public function profile()
    {
        return view('user-panel.profile.profile');
    }

    public function post()
    {
        return view('user-panel.post.post');
    }

    public function managePost()
    {
        return view('user-panel.post.manage');
    }

}
