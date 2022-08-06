@extends('layouts.app')

@section('title','View All Post')

@section('header')
    <h1 class="text-align-center">
        All posts
    </h1>
@endsection

@section('content')
    <p class="lead">This is the main class</p>

    @if($posts)
    <ul>
        @foreach ($posts as $post)
            <li>{{ $post }}</li>  
        @endforeach
    </ul>

    @endif
@endsection

@section('footer')
    <p class="text-muted">This is the footer</p>
@endsection