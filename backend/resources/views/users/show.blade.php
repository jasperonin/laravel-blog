@extends('layouts.app')

@section ('title', 'Profile')

@section('content')

    <div class="row mt-2 mb-5">
         <div class="col-4">
            @if($user->image)
                <img src="{{ asset('storage/avatars/' .$user->image) }}" alt="{{ $user->image }}" class="img-thumbnail w-100">                
            @else
                <i class="fa-solid fa-image fa-10x d-block text-center"></i>
            @endif
         </div>
         <div class="col-8">
            <h2 class="display-6"> {{ $user->name }} </h2> <!-- name of user in db -->
            <h2 class="display-6"> {{ $user->email }} </h2> <!-- name of user in db -->
            <a href="{{ route('profile.edit') }}" class="text-decoration-none">Edit Profile</a>
         </div>
    </div>

    @if($user->posts)

        <ul class="list-group mb-5">
            @foreach ($user->posts as $post)
                <li class="list-group-item py-4">
                    <a href="{{ route('post.show'), $post->id }}"></a>
                    <h3 class="h4"> {{ $post->title }} </h3>
                </li>

                <p class="fw-light mb-0">
                    {{ $post->body }}
                </p>
            @endforeach
        </ul>

    @endif
@endsection