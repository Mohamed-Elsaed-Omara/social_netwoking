@extends('Website.layouts.master')
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
        </style>
    </head>

    <body>
        <div class="container " style="margin-top: 140px">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <h2>Edit Post</h2>
            <form action="{{ url('posts/'. $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="3">{{ $post->content }}</textarea>
                    @error('content')
                    <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Post Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @if ($post->image)
                        <img src="{{ asset($post->image) }}" alt="Profile Image" class="mt-2" width="100">
                    @endif
                    @error('image')
                    <div class="alert text-danger">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">update</button>
        </div>
        </form>
        </div>
    </body>

    </html>
@endsection
@section('js')
@endsection
