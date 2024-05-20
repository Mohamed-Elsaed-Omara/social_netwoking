@extends('Website.layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    
</head>
<body>
    <div class="container centered-input-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="container profile-container" style="margin-top: 150px">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <img src="{{ asset(Auth::user()->image) }}" alt="User Image" class="profile-img">
                    </div>
                    <div>
                        <h4 class="card-title">{{ Auth::user()->name }}</h4>
                        <p class="card-text">Email: {{ Auth::user()->email }}</p>
                        <p class="card-text">Joined: {{ Auth::user()->created_at->format('d M Y') }}</p>
                        <!-- يمكنك إضافة المزيد من المعلومات هنا -->
                        <a href="{{ url('/profile-edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>


        <h3>User Posts</h3>
        <div class="card-container">
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset($post->user->image ?? 'default-user.png') }}" alt="User Image" class="user-image">
                        <div class="user-details">
                            <p class="user-name">{{ $post->user->name }}</p>
                            <p class="post-time">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="card-content">
                        <p class="post-text">{{ $post->content }}</p>
                        @if ($post->image)
                            <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image">
                        @endif
                    </div>
                    <div class="card-actions">
                        <div class="action-buttons">
                            <form action="{{ url('post-like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="action-button">Like</button>
                            </form>
                            <button class="action-button" data-toggle="collapse" data-target="#commentForm-{{ $post->id }}">Comment</button>
                        </div>
                        <div class="like-comment">
                            <span>{{ $post->likes_count }} إعجابات</span>
                            <span>{{ $post->comments_count }} تعليقات</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="commentForm-{{ $post->id }}" class="collapse comments-section">
                            <form action="{{ url('post-comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" rows="2" placeholder="Add a comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </form>
                            @foreach ($post->comments as $comment)
                                <div class="card-body mt-2" style="background-color: white">
                                    <div class="media">
                                        <img src="{{ asset($comment->user->image) }}" alt="{{ $comment->user->name }}" class="mr-3 rounded-circle" style="width: 50px; height: 50px;">
                                        <div class="media-body">
                                            <h5 class="mt-0"><a href="{{ url('/view-profile' . $comment->user_id) }}" style="color: black"> {{ $comment->user->name }} </a></h5>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="post-actions">
                            <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('posts', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
@endsection
