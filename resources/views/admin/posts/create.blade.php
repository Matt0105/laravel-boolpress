@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-3" style="color:white; text-align: center">Create New Post</h2>
                <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <select class="form-select mb-3" name="category_id">
                        <option value="">Select a Category</option>
                        @foreach ($categories as $category)
                            <option {{old("category_id") == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>   
                        @endforeach
                        @error('category_id')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </select>

                    <label for="tags" class="form-label">Tags</label>
                    @foreach ($tags as $tag)
                    
                        <div class="form-check">
                            <input {{in_array($tag->id, old("tags", [])) ? "checked" : ""}} class="form-check-input" type="checkbox" value="{{$tag->id}}" name="tags[]">
                            <label class="form-check-label" for="flexCheckDefault">
                            {{$tag->name}}
                            </label>
                        </div>
                    @endforeach
                    @error('tags.*')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                    

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content">{{old('content')}}</textarea>
                        @error('content')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                      </div>
                    <input class="btn btn-success" type="submit">
                </form>
            </div>
        </div>
        <a class="btn btn-dark mt-2" href="{{url()->previous()}}">< Back</a>
    </div>
@endsection