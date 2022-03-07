@extends('layouts.app')

@section('content')
    <div class="show-container">
        <h2 class="mb-3">Create New Category</h2>
        <form action="{{route('admin.categories.store')}}" method="POST">
            @csrf
            @method("POST")

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                @error('name')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <input class="btn btn-success send" type="submit">
        </form>
        <a class="btn btn-dark mt-2" href="{{url()->previous()}}">< Back</a>
    </div>
@endsection