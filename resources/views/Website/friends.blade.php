@extends('Website.layouts.master')

@section('content')
    <div class="container" style="margin-top: 150px;">
        <h3>Users You Can Add as Friends</h3>
        @if($friends->isEmpty())
            <p>No friends available to add as friends.</p>
        @else
            <div class="row">
                @foreach($friends as $friend)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset($friend->receiver->image ?? '') }}" alt="{{ $friend->name }}" class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                                <a href="{{ url('/view-profile'.$friend->receiver->id) }}">
                                    <h5 class="card-title">{{ $friend->receiver->name }}</h5>
                                </a>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
