{{-- @extends('Website.layouts.master')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset($user->image ?? 'default-user.png') }}" alt="{{ $user->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <h5 class="card-title">{{ $user->name }}</h5>

                            @php
                                $existingRequest = App\Models\Connection::where(function ($query) use ($user) {
                                    $query->where('sender_id', auth()->id())
                                            ->where('receiver_id', $user->id);
                                        })->orWhere(function ($query) use ($user) {
                                    $query->where('sender_id', $user->id)
                                        ->where('receiver_id', auth()->id());
                                        })->first();
                            @endphp

                            @if ($existingRequest && $existingRequest->status == '0')
                                <button class="btn btn-secondary" disabled>Pending</button>
                            @else
                                <form action="{{ url('addFriend/'.$user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"> Add Friend</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
 --}}


@extends('Website.master')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <h3>Users You Can Add as Friends</h3>
        @if($nonFriends->isEmpty())
            <p>No users available to add as friends.</p>
        @else
            <div class="row">
                @foreach($nonFriends as $user)
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset($user->image ?? '') }}" alt="{{ $user->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                                <a href="{{ url('/view-profile'.$user->id) }}">
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                </a>
                                <form action="{{ url('addFriend/'.$user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add Friend</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
