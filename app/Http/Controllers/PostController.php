<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $tags = Cache::remember('tags', now()->addDays(3), function () {
            return Tag::whereHas('posts', function ($query) {
                $query->published();
            })->take(10)->get();
        });

        return view(
            'main.posts.index',
            [
                'tags' => $tags
            ]
        );
    }

    public function show(Post $post)
    {
        return view(
            'main.posts.show',
            [
                'post' => $post
            ]
        );
    }
}
