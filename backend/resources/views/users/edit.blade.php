@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
	@csrf
	@method('PATCH')

    <div class="row mt-2 mb-3">
        <div class="col-10">
            @if ($user->avatar)
                <img src="{{ asset('storage/avatars/' .$user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail mb-3">   
            @else
                <i class="fa-solid fa-image-10x d-block text-center"></i>
            @endif
    
            <input type="file" name="avatar" class="form-control mt-1" aria-describedby="avatar-info">
            <div class="form-text" id="avatar-info">
                Acceptable formats: JPG, JPEG, PNG, GIF <br>
                Maximum file: 1MB <!-- maximum file size of  1MB -->
            </div>
        </div>
    </div>
	<div class="col-10">                                        <!-- to display the previous value in DB -->
        <label for="name" class="form-label text-muted" value="{{ old('name', $user->name) }}">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="col-10">
        <label for="email" class="form-label text-muted" value=" {{old('email', $user->email)}} ">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3 px-5">Save</button>
</form>

@endsection