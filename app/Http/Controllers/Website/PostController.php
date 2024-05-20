<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'user_id' => auth()->user()->id,
            'content' => request()->content,
        ];

        if(request()->hasFile('image')){
            $fileName = now()->timestamp .'_'. $request->file('image')->getClientOriginalName();

            $filePath = $filePath = "uploads/posts/" . $fileName;
                    
            $request->file('image')->move('uploads/posts/', $fileName);

            $data['image'] = $filePath;
        }

        Post::create($data);

        return back()->with('success','The Post published successfully');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $postId)
    {
        $post = Post::findOrFail($postId);

        return view('Website.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'content' => request()->content,
        ];

        if(request()->hasFile('image')){
            $fileName = now()->timestamp .'_'. $request->file('image')->getClientOriginalName();

            $filePath = $filePath = "uploads/posts/" . $fileName;
                    
            $request->file('image')->move('uploads/posts/', $fileName);

            $data['image'] = $filePath;
        }

        $post->update($data);

        return back()->with('success','The Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success','The Post deleted successfully');
    }

    public function downImage($id)
    {
        $post = Post::findOrFail($id);

        $filePath = public_path($post->image);

        return response()->download($filePath);
    }
}
