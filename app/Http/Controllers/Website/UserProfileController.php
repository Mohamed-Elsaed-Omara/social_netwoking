<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getAllUsers()
    {
        $userId = Auth::id();
        
        $nonFriends = User::where('id', '!=', $userId)
            ->whereDoesntHave('sentFriendRequests', function($query) use ($userId) {
                $query->where('receiver_id', $userId);
            })
            ->whereDoesntHave('receivedFriendRequests', function($query) use ($userId) {
                $query->where('sender_id', $userId);
            })
            ->get();

        return view('Website.users', compact('nonFriends'));
    }

    
    public function profile()
    {
        $posts = auth()->user()->posts()->withCount('comments', 'likes')
        ->orderBy('created_at', 'desc')->get();

        return view('Website.profile.profile', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profileEdit()
    {
        $user = auth()->user();
        return view('Website.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $validated = $request->validated();

        $data = request()->all();

        if (request()->hasFile('image')) {
            $fileName = now()->timestamp . '_' . $request->file('image')->getClientOriginalName();

            $filePath = $filePath = "uploads/users/" . $fileName;

            $request->file('image')->move('uploads/users/', $fileName);

            $data['image'] = $filePath;
        }

        $user = auth()->user();

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages(['current_password' => 'Current password is incorrect']);
            }

            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }
        }

        auth()->user()->update($data);

        return back()->with('success', 'The profile save change successfully');
    }

    public function viewProfile($id)
    {
        $userProfile = User::with(['posts' => function ($query) {
            $query->withCount(['likes', 'comments'])->orderBy('created_at', 'desc');
        }])->find($id);

        return view('Website.profile.viewProfile', compact('userProfile'));
    }

    public function showFriendUser()
    {
        $friends = Auth::user()->friends()->where('status',1)->get();

        return view('Website.friends',compact('friends'));
    }
}
