<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user()->sentFriendRequests()->where('status', 0)->get();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $senderId = auth()->id();
        $receiverId = $request->receiver_id;

        $existingConnection = Connection::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->first();

        if ($existingConnection) {
            return response()->json(['message' => 'Friend request already exists or pending.'], 400);
        }

        $connection = Connection::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ]);

        return response()->json($connection, 201);
    }


    public function update(Request $request, string $id)
    {
        $connection = Connection::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $connection->update($request->all());

        return response()->json($connection);
    }


    public function destroy(string $id)
    {
        Connection::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
