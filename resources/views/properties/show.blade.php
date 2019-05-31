@extends('layouts.app')

@section('content')
    @role('admin')
    <div>
        <a href="{{url('/properties/' . $property->slug . '/edit')}}">Edit property</a>
    </div>
    @endrole
    <div>
        {{$property->name}}
    </div>
    <div>{{$property->country}}</div>

    <h2>Available Styles</h2>
    @foreach($property->styles as $style)
        <div>{{$style->name}}</div>
        <div>{{$style->description}}</div>
    @endforeach


    <div>Comments</div>
    @foreach ($property->comments as $comment)
        <p>{{$comment->body}} posted by {{$comment->user->name}}</p>
    @endforeach

    @if (Auth::check())
       <h2>Post a comment</h2>
       <form action="{{ url('/properties/' . $property->slug . '/comment/')}}" method="POST">
           @csrf
           <input type="text" name="body" placeholder="Comment">
           <button type="submit">Submit</button>
       </form>
    @else
        <p>Sign in to post a comment</p>
        <a href="/login">Login</a>
    @endif

@endsection
