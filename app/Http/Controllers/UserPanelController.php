<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends BaseController
{
    public function index(Request $request)
    {
        return view('user-panel.home.home');
    }

    public function blogDetails(Request $request, $id)
    {

        $post = Post::where('id', $id)->first();
        $rv = [
            'id' => $id,
            'post' => $post,
            'related_posts' => Post::where('user_id', $post['user_id'])->where('id', '!=', $id)->where('status', 'published')->take(3)->get()
        ];

        if ($post->views_count == 0) {
            $post->views_count = 1;
        } else {
            $post->views_count = $post->views_count + 1;
        }
        $post->save();
        return view('user-panel.blog-details.blog-details', $rv);
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

    public function my_post()
    {
        return view('user-panel.post.my-post');
    }

    public function search_post()
    {
        return view('user-panel.post.search-post');
    }

    public function managePost(Request $request, $id)
    {
        $rv = [
            'id' => $id
        ];

        return view('user-panel.post.manage', $rv);
    }


    public function categories()
    {
        return view('user-panel.categories.categories');
    }

    public function manageCategory(Request $request, $id)
    {
        $rv = [
            'id' => $id
        ];

        return view('user-panel.categories.manage', $rv);
    }

}
