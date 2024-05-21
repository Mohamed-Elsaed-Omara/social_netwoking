@extends('Website.master')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <h3> FriendShip Requests</h3>
        @if($users->isEmpty())
            <p> There are no friend requests</p>
        @else
            <div class="list-group">
                @foreach($users as $user)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <img src="{{ asset($user->receiver->image ?? 'default-user.png') }}" alt="{{-- {{ $request->name }} --}}" class="rounded-circle mr-3" style="width: 50px; height: 50px;">
                            <a href="{{ url('/view-profile'.$user->receiver->id) }}">

                                <span>{{ $user->receiver->name }}</span>
                            </a>
                        </div>
                        <div>
                            <form action="{{ url('accept-friend/'. $user->receiver->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->receiver->id }}">
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                            <form action="{{ url('reject-friend/'. $user->receiver->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->receiver->id }}">
                                <button type="submit" class="btn btn-danger">reject</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script src="{{asset('js/app.js')}}"></script>
@endsection
