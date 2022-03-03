@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mb-3" style="color:white; text-align: center">All Categories</h2>
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
                    <th colspan=2 scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>

                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.categories.show', $category)}}" style="color: white">View all posts</a>
                        </td>
                        <td>
                            <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                            @csrf
                            @method("DELETE")

                                <input class="btn btn-danger" type="submit" value="Delete Category" style="color: white">
                            </form>
                            
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
        </div>
        {{-- <div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">{{$posts->links()}}</div> --}}
    </div>
</div>

@endsection