<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = auth()->user();

        $data = [
            'user_id' => $user->id,
            'content' => request()->content,
        ];

        if(request()->hasFile('image')){
            $fileName = now()->timestamp .'_'. $request->file('image')->getClientOriginalName();

            $filePath = $filePath = "uploads/posts/" . $fileName;
                    
            $request->file('image')->move('uploads/posts/', $fileName);

            $data['image'] = $filePath;
        }

        $post = Post::create($data);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        $post = Post::findOrFail($id);

        if ($post->user_id !== $user->id) {
            return response()->json(['error' => 'You can only update your own posts.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'content' => ['sometimes|required', 'string'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        var_dump($request->all());
        $data = $request->only(['content']);

        if ($request->hasFile('image')) {
            $fileName = now()->timestamp . '_' . $request->file('image')->getClientOriginalName();
            $filePath = "uploads/users/" . $fileName;
            $request->file('image')->move('uploads/users/', $fileName);
            $data['image'] = $filePath;
        }

        $post->update($data);

        return response()->json($post,200);
    }
    
    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'You can only delete your own posts.'], 403);
        }
        $post->delete();

        return response()->json(['msg' => 'Post deleted successfully'], 204);
    }
    
}
