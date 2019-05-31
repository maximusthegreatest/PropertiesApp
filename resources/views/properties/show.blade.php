@extends('layouts.app')

@section('content')

    @role('admin')
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('/properties/' . $property->slug . '/edit')}}"><div class="btn btn-primary">Edit property</div></a>
        </div>
    </div>
    @endrole

    <div class="row mt-5">
        <div class="col-md-6">
            <ul style="list-style-type: none;">
                <li><em>Property Name:</em> {{$property->name}}</li>
                <li><em>Property Description:</em> {{$property->description}}</li>
                <li><em>Available On:</em> {{$property->available_on}}</li>
                <li><em>Rating:</em> {{$property->rating}}</li>
                <li><em>Price:</em> ${{number_format($property->price)}}</li>
                <li><em>Country:</em> {{$property->country}}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="propImage" style="background-image: url('{{ asset('/images/'. $property->photo) }}'); width: 100%; min-height: 300px; background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Available Styles</h3>
            @foreach($property->styles as $style)
                <h5>{{$style->style}}</h5>
                <p>{{$style->description}}</p>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Comments</h3>
            @foreach ($property->comments as $comment)
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="card-title"> {{$comment->user->name}} commented</div>
                        <p class="card-text">{{$comment->body}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row mt-4 pb-5">
        <div class="col-md-12">
            @if (Auth::check())
                <h2>Post a comment</h2>
                <form action="{{ url('/properties/' . $property->slug . '/comment/')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input class="form-control" id="comment" type="text" name="body" placeholder="Comment">
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            @else
                <p>Sign in to post a comment</p>
                <a href="/login">Login</a>
            @endif
        </div>
    </div>



@endsection
