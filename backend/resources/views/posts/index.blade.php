@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @forelse ($all_posts as $post)
        
        <div class="mt-2 border border-2 rounded p-3 px-4 mb-3">
            <a href="{{ route('post.show', $post->id) }}">
                <h2 class="h4"> {{ $post->title }}</h2>
            </a>
            <h3 class="h6 text-muted">{{ $post->user->name }}</h3>
            <p class="fw-light mb-0">{{ $post->body }}</p>

            @if ($post->user->id === Auth::user()->id)
                <form action="#" class="float-end" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen">Edit</i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-can"></i>
                        Delete
                    </button>
                </form>
            @endif
        </div>
    @empty
    <div style="margin-top: 100px;">
        <h2 class="text-muted text-center">No post available</h2>
        <p class="text-center">
                <a href="{{ route('post.create') }}" class="text-decoration-none"> Create a post</a>
        </p>
    </div>
    @endforelse


  
@endsection