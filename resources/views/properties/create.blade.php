@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <h1>Create Property</h1>
    <form method="POST" action="/properties/create" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" class="form-control" type="text" name="name" placeholder="name">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" rows="10" placeholder="description"></textarea>
        </div>

        <div class="form-group">
            <label for="available">Available On</label>
            <input id="available" class="form-control" type="date" name="available_on" placeholder="available on">
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <input id="rating" class="form-control" type="text" name="rating" placeholder="rating">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input id="price" class="form-control" type="text" name="price" placeholder="price">
        </div>

        <div class="form-group">
            <label for=""></label>
            <input class="form-control" type="text" name="country" placeholder="country">
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input id="photo" class="form-control" type="file" name="photo" accept="image/*">
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
    </form>
@endsection
