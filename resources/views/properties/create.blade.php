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
        <input type="text" name="name" placeholder="name">
        <textarea name="description" rows="10" placeholder="description"></textarea>
        <input type="date" name="available_on" placeholder="available on">
        <input type="text" name="rating" placeholder="rating">
        <input type="text" name="price" placeholder="price">
        <input type="text" name="country" placeholder="country">
        <input type="file" name="photo" accept="image/*">
        <button type="submit">Create</button>
    </form>
@endsection
