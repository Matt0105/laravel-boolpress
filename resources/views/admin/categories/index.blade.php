@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mb-3" style="color:white; text-align: center">All Categories</h2>
            @if (session("status"))
                <div class="alert alert-danger">
                    {{session("status")}}
                </div>
            @elseif(session("warning"))
                <div class="alert alert-warning">
                    {{session("warning")}}
                </div>
            @endif
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th colspan=2 scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="table-row">

                        <td>{{$category->name}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.categories.show', $category)}}" style="color: white">View all posts</a>
                        </td>
                        <td>
                            @if(Auth::user()->roles()->get()->contains(1))
                                <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                @csrf
                                @method("DELETE")

                                    <input class="btn btn-danger" type="submit" value="Delete Category" style="color: white">
                                </form>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
        {{-- <div style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center">{{$posts->links()}}</div> --}}
    </div>
</div>

@endsection