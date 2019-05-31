@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{url('/properties/' . $property->id)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <label for="name">Property Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{$property->name}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="10">{{$property->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="date">Available On</label>
                    <input class="form-control" id="date" type="date" name="available_on" value="{{$property->available_on}}">
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input class="form-control" id="rating" type="text" name="rating" value="{{$property->rating}}">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input class="form-control" id="price" type="text" name="price" value="{{$property->price}}">
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input class="form-control" id="country" type="text" name="country" value="{{$property->country}}">
                </div>

                <div class="form-group">
                    <label for="photo">Choose a new photo</label>
                    <input type="file" name="photo" accept="image/*">
                </div>

                <div class="form-group">
                    <h2>Current Photo</h2>
                    <img src="{{asset('images/' . $property->photo)}}" alt="">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
                <div id="deleteBtn" class="btn btn-danger" type="text">Delete</div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form id="deleteForm" method="POST" action="{{url('/properties/' . $property->id)}}">
                @csrf
                @method('delete')
            </form>
        </div>
    </div>


    
@endsection


<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById("deleteBtn").addEventListener("click", submitDelete);

    }, false);

    function submitDelete() {
        document.getElementById('deleteForm').submit();
    }

</script>
