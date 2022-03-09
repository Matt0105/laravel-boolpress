@extends('layouts.admin')

@section('content')

<div class="show-container">
    <p><em>Category: {{$post->category()->first()->name}}</em></p>
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    @if(!empty($post->image))
        <img src="{{asset("storage/" . $post->image)}}" alt="{{$post->title}}">
    @endif
    <p class="author"><em>Author: {{$post->user()->first()->name}}</em></p>
    <p class="tag">
        <em>Tags: </em> 
        @foreach ($post->tags()->get() as $tag) 
            <span class="tag-badge">{{$tag->name}}</span>
        @endforeach
    </p>
    <a class="btn btn-dark" href="{{url()->previous()}}">< Back</a>
</div>
@endsection