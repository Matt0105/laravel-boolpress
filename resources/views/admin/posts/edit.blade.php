@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{route('admin.posts.update', $post)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content">{{$post->content}}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                    <input class="btn btn-success" type="submit">
                </form>
            </div>
        </div>
    </div>
@endsection