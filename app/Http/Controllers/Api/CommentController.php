<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        
        $newComment = Comment::create([
            'user_id' => $user->id,
            'post_id' => request()->postId,
            'comment' => request()->comment
        ]);

        return response()->json($newComment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postId)
    {
        $post = Post::findOrFail($postId);
        $comment = $post->comments;

        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'You can only update your own comments.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'sometimes|required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->only(['comment']);
        $comment->update($data);

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'You can only delete your own comments.'], 403);
        }

        $comment->delete();

        $res = [
            'msg' => 'Comment eleted success fully',
        ];
        return response()->json($res, 204);
    }
    
}
