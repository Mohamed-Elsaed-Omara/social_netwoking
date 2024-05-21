@extends('Website.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        .profile-container {
            margin-top: 50px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .post-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
        }
        .post-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .post-card .user-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
        .post-card .comment-section {
            margin-top: 10px;
        }
        .post-card .comment {
            border-top: 1px solid #ddd;
            padding-top: 5px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container profile-container" style="margin-top: 150px">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <img src="{{ asset($userProfile->image) }}" alt="User Image" class="profile-img">
                    </div>
                    <div>
                        <h4 class="card-title">{{ $userProfile->name }}</h4>
                        <p class="card-text">Email: {{ $userProfile->email }}</p>
                        <p class="card-text">Joined: {{ $userProfile->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Posts -->
    <div class="container profile-container" style="margin-top: 150px; display: flex; justify-content: center;">
        <div style="max-width: 800px;">
            @foreach($userProfile->posts as $post)
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset($post->user->image ?? '') }}" alt="User Image" class="user-image">
                    <div class="user-details">
                        <a href="{{ url('/view-profile'.$post->user->id) }}">

                            <p class="user-name">{{ $post->user->name }}</p>
                        </a>
                        <p class="post-time">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="card-content">
                    <p class="post-text">{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset($post->image) }}" alt="Post Image" class="post-image">
                        <a href="{{ url('download-image/'.$post->id) }}" >Download </a>

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
            </div>
            @endforeach
        </div>
    </div>
    
    </div>
</body>
</html>
@endsection

@section('js')
<!-- Include any JS scripts if necessary -->
@endsection
