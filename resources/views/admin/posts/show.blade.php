@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="color:white">
        <p><em>Category: {{$post->category()->first()->name}}</em></p>
        <h1>{{$post->title}}</h1>
        <p>{{$post->content}}</p>
        <p><em>Author: {{$post->user()->first()->name}}</em></p>
    </div>
    <a class="btn btn-dark" href="{{url()->previous()}}">< Back</a>
</div>
@endsection