@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th colspan=3 scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        
                    <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td><a class="btn btn-primary" href="" style="color: white">View</a></td>
                    <td><a class="btn btn-success" href="" style="color: white">Edit</a></td>
                    <td><a class="btn btn-danger" href="" style="color: white">Delete</a></td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection