@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @if (session("status"))
                <div class="alert alert-danger">
                    {{session("status")}}
                </div>
            @endif
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Content</th>
                    <th colspan=3 scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category_id}}</td>
                        <td>{{$post->content}}</td>
                        <td><a class="btn btn-primary" href="{{route('admin.posts.show', $post)}}" style="color: white">View</a></td>
                            
                        @if ($post->user_id == Auth::user()->id)
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
                        @endif
                        

                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        <div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">{{$posts->links()}}</div>
    </div>
</div>

@endsection