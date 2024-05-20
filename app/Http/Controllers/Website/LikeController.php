<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function likePost(string $postId)
    {
        $post = Post::findOrFail($postId);

        $currentUserId = auth()->id();

        $existingLike = Like::where('user_id', $currentUserId)
        ->where('post_id', $postId)->first();

        if($existingLike){
            
            Like::find($existingLike->id)->delete();
            return back();
        }

        Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $postId,
        ]);

        return back();
    }

    public function commentPost(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $postId,
            'comment' => request()->comment
        ]);

        return redirect()->back();
    }
}
