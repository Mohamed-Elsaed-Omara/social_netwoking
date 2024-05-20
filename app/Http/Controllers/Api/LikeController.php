<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id'
        ]);

        $data['user_id'] = Auth::id();

        $like = Like::create($data);
        return response()->json($like, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $like = Like::findOrFail($id);

        if ($like->user_id !== Auth::id()) {
            return response()->json(['error' => 'You can only unlike your own likes.'], 403);
        }

        $like->delete();
        return response()->json(null, 204);
    }
}
