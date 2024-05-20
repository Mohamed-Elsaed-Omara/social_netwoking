<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\FriendRequest;
use App\Models\User;
use App\Notifications\FriendRequestNoti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendRequestController extends Controller
{
    public function addFriend($senderId)
    {
        $receiverId = Auth::id();
        
        Connection::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ]);

        $sender = User::findOrFail($senderId);

        $receiver = User::findOrFail($receiverId);
    
        // Send notification
        $receiver->notify(new FriendRequestNoti($sender));

        return back();
    }

    public function rejectFriend(Request $request)
    {
        $friend = Connection::where('sender_id',Auth::id())
                            ->where('receiver_id',request()->receiver_id)
                            ->where('status',0)
                            ->first();

        $friend->delete();

        return back();
    }

    public function viewFriendshipReequests()
    {
        $users = Auth::user()->sentFriendRequests()->where('status',0)->get();

        return view('Website.friendshipRequest', compact('users'));
    }

    public function acceptFriend(Request $request)
    {
        $friend = Connection::all()->where('sender_id',Auth::id())
        ->where('receiver_id',request()->receiver_id)->first();

        $friend->update([
            'status' => true,
        ]);

        return back();
    }
}
