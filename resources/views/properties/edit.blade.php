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

    <form method="POST" action="{{url('/properties/' . $property->id)}}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <input type="text" name="name" value="{{$property->name}}">
        <textarea name="description" rows="10">{{$property->description}}</textarea>
        <input type="date" name="available_on" value="{{$property->available_on}}">
        <input type="text" name="rating" value="{{$property->rating}}">
        <input type="text" name="price" value="{{$property->price}}">
        <input type="text" name="country" value="{{$property->country}}">
        <img src="{{asset('images/' . $property->photo)}}" alt="">
        <input type="file" name="photo" accept="image/*">

        <button type="submit">Edit</button>
    </form>

    <form method="POST" action="{{url('/properties/' . $property->id)}}">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>
    </form>
    
@endsection
