<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserPanelController extends BaseController
{

    public function index(Request $request)
    {
        $rv = [
            'featured_posts' => Post::where('is_featured', '1')->where('status', 'published')->take(5)->get(),
            'latest_posts' => Post::where('status', 'published')->orderBy('created_at', 'desc')->take(5)->get(),
            'most_viewed_posts' => Post::where('status', 'published')->orderBy('views_count', 'desc')->take(5)->get(),
        ];
        return view('user-panel.home.home', $rv);
    }

    public function blogDetails(Request $request, $id)
    {

        $post = Post::where('id', $id)->first();
        $rv = [
            'id' => $id,
            'post' => $post,
            'related_posts' => Post::where('user_id', $post['user_id'])->where('id', '!=', $id)->where('status', 'published')->take(3)->get(),
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
        return view('user-panel.new_login.login');
    }

    public function forgotPassword()
    {
        return view('user-panel.new_forgot.forgot');
    }

    public function resetPassword()
    {
        return view('user-panel.reset.reset');
    }

    public function profile()
    {
        return view('user-panel.profile.profile');
    }

    public function post(Request $request)
    {
        // Data sanitization
        $filter = [
            'orderBy' => $request->orderBy ?? 'id',
            'order' => $request->sort_mode ?? 'desc',
        ];

        $query = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);

        $result = $query->paginate(20);

        $rv = [
            'blogs' => $result,
        ];

        return view('user-panel.post.post', $rv);
    }

    public function my_post(Request $request)
    {

        // Data sanitization
        $filter = [
            'keyword' => $request->keyword ?? '',
            'is_featured' => $request->is_featured ?? '',
            'status' => $request->status ?? '',
            'orderBy' => $request->orderBy ?? 'id',
            'order' => $request->sort_mode ?? 'asc',
        ];


        $rv = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }

        if (!empty($filter['status'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('status', $filter['status']);
            });
        }

        if (!empty($filter['is_featured'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('is_featured', $filter['is_featured']);
            });
        }
        $result =  $rv->paginate(20);

        return view('user-panel.post.my-post', compact('result'));
    }

    public function search_post(Request $request)
    {
        // Data sanitization
        $filter = [
            'keyword' => $request->keyword ?? '',
            'is_featured' => $request->is_featured ?? '',
            'status' => $request->status ?? '',
            'orderBy' => $request->orderBy ?? 'id',
            'order' => $request->sort_mode ?? 'asc',
        ];

        $query = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $query->where(function ($q) use ($filter) {
                $q->where('title', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }

        if (!empty($filter['status'])) {
            $query->where(function ($q) use ($filter) {
                $q->where('status', $filter['status']);
            });
        }

        if (!empty($filter['is_featured'])) {
            $query->where(function ($q) use ($filter) {
                $q->where('is_featured', $filter['is_featured']);
            });
        }
        $result = $query->paginate(20);

        $rv = [
            'posts' => $result,
        ];
        return view('user-panel.post.search-post', $rv);
    }

    public function feature_post()
    {
        // Data sanitization
        $filter = [
            'orderBy' => $request->orderBy ?? 'id',
            'order' => $request->sort_mode ?? 'asc',
        ];

        $query = Post::with('author')->where('is_featured', 1)->orderBy($filter['orderBy'], $filter['order']);

        $result = $query->paginate(20);

        $rv = [
            'featured_posts' => $result,
        ];

        return view('user-panel.post.feature-post', $rv);
    }

    public function latest_post()
    {
        // Data sanitization
        $filter = [
            'orderBy' => $request->orderBy ?? 'id',
            'order' => $request->sort_mode ?? 'desc',
        ];

        $query = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);

        $result = $query->paginate(20);

        $rv = [
            'latest_post' => $result,
        ];

        return view('user-panel.post.latest-post', $rv);
    }

    public function most_viewed_post()
    {

        // Data sanitization
        $filter = [
            'orderBy' => $request->orderBy ?? 'views_count',
            'order' => $request->sort_mode ?? 'desc',
        ];

        $query = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);

        $result = $query->paginate(20);

        $rv = [
            'most_views' => $result,
        ];

        return view('user-panel.post.most-viewed-post', $rv);
    }

    public function editPost(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
        return view('user-panel.post.edit-log', ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        return view('user-panel.post.create-log');
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
