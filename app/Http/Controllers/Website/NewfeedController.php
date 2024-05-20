<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class NewfeedController extends Controller
{
    public function index()
    {
        $posts = Post::withCount(['comments', 'likes'])->latest()->get();

        return view('Website.news_feed',compact('posts'));
    }

    
}
