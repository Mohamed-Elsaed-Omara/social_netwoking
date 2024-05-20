@extends('Website.layouts.master')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container centered-input-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>



    <div class="card-container">


        <input type="text" placeholder="Add New Post" class="custom-input" style="margin: 20px" data-toggle="modal"
            data-target="#newPostModalLabel">
        </input>
        <!-- Modal -->

        <div class="modal fade" id="newPostModalLabel" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('posts') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($posts as $post)
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
@endsection
