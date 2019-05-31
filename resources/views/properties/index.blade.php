@extends('layouts.app')

@section('content')
    @role('admin')
    <div>
        <a href="/properties/create"><div class="btn btn-primary">Create property</div></a>
    </div>
    @endrole
    @foreach ($properties as $property)
        <div class="row" style="margin-top: 50px;">
            <div class="col-md-6">
                <h5>Property Name: {{$property->name}}</h5>
                <h5 class="mt-3">Property Description:</h5><p>{{ str_limit($property->description, $limit = 150, $end = '...') }}</p>
                <a href="{{url('properties/' . $property->slug)}}"><div class="btn btn-primary">View Details</div></a>
            </div>
            <div class="col-md-6">
                <div class="propImage" style="background-image: url('{{ asset('/images/'. $property->photo) }}'); width: 100%; min-height: 300px; background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
            </div>
        </div>

    @endforeach
    <div class="mt-5" style="display: flex; justify-content: center;">
        {{ $properties->links() }}
    </div>

    
@endsection
