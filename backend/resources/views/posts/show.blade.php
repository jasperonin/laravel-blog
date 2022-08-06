@extends('layouts.app')

@section('title', 'Show Post')

@section('content')

<div class="mt-2 border border-2 rounded py-4 px-3">
    
    <h2 class="h4"> {{ $post->title }} </h2>
    <h3 class="h6 text-muted">{{ $post->user->name }}</h3>
    <p class="fw-light mb-0">{{ $post->body }}</p>
</div>

<form action="{{ route('comment.store', $post->id) }}" method="post">
    @csrf
    <div class="input-group mt-5">
        <input type="text" name="comment" id="comment" class="form-control" value="{{ old('comment') }}" placeholder="Add your comment...">
        <button type="submit" class="btn btn-outline-primary btn-sm w-100 mt-2">Post</button>
    </div>
    @error('comment')
        <p class="text-danger small">{{ $message }}</p>
    @enderror
</form>

@if($post->comment)
<div class="mt-2 mb-5">
    @foreach ($post->comment as $comment)
        
        <div class="row p-2">
            <div class="col-10">

                <span class="fw-bold">{{ $comment->user->name }}</span>
                <span class="small text-muted">{{ $comment->created_at }}</span>
                <p class="mb-0">
                    {{ $comment->body }}
                </p>
            </div>
           
            @if($comment -> user_id === Auth::user()->id)
            <div class="col-2 text-end">
                <form action="{{ route('comment.destroy' ,$comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-alt"></i>
                        
                    </button>
                </form>
            </div>
            @endif
        </div>
    @endforeach
</div>
@endif
@endsection