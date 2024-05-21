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
    </style>
</head>
<body>
    <div class="container " style="margin-top: 140px">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif
        <h2>Edit Profile</h2>
        <form action="{{ url('/profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" >
                @error('email')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if ($user->image)
                    <img src="{{ asset($user->image) }}" alt="Profile Image" class="mt-2" width="100">
                @endif
                @error('image')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                @error('current_password')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>

@endsection
@section('js')
	
@endsection