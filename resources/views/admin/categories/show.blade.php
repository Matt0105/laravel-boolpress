@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mb-3" style="color:white; text-align: center">All Posts with Category '{{$category->name}}'</h2>
            @if (session("status"))
                <div class="alert alert-danger">
                    {{session("status")}}
                </div>
            @endif
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Author</th>
                    <th scope="col">Last Edit</th>
                    <th colspan="4" scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($category->posts()->get() as $post)
                    {{-- @dd($post->user()) --}}
                    <tr class="table-row">
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            @foreach ($post->tags()->get() as $tag)
                                <ul style="list-style-type: none">
                                    <li style="text-decoration: underline">#{{$tag->name}}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>{{$post->content}}</td>
                        <td>{{$post->user()->first()->name}}</td>
                        <td>{{$post->updated_at}}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.posts.show', $post)}}" style="color: white">View</a></td>
                        <td>
                                @if ($post->user_id == Auth::user()->id)
                                    <a class="btn btn-success" href="{{route('admin.posts.edit', $post)}}" style="color: white">Edit</a>
                                @endif
                        </td>
                        <td>
                                @if ($post->user_id == Auth::user()->id)
                                    <form action="{{route("admin.posts.destroy", $post)}}" method="POST">
                                    @csrf
                                    @method("DELETE")

                                    <input class="btn btn-danger" type="submit" value="Delete" style="color:white">
                                    </form>
                                @endif
                                
                        </td>
                            
                        {{-- @if ($post->user_id == Auth::user()->id)
                            <td><a class="btn btn-success" href="{{route('admin.posts.edit', $post)}}" style="color: white">Edit</a></td>
                            <td>
                                <form action="{{route("admin.posts.destroy", $post)}}" method="POST">
                                @csrf
                                @method("DELETE")

                                <input class="btn btn-danger" type="submit" value="Delete" style="color:white">
                                </form>
                            </td>
                        @else
                            <td><a class="btn btn-secondary" href="" style="color: white">Edit</a></td>
                            <td>
                                <form action="" method="POST">
                                @csrf
                                @method("POST")

                                <input class="btn btn-secondary" type="submit" value="Delete" style="color:white">
                                </form>
                            </td>
                        @endif --}}
                        

                    </tr>
                    @endforeach
                
                </tbody>
            </table>
            <a class="btn btn-dark" href="{{url()->previous()}}">< Back</a>
        </div>
        {{-- <div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">{{$posts->links()}}</div> --}}
    </div>
</div>

@endsection