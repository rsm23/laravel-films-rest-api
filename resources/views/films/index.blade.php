@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($films as $film)
                <div class="card col-md-3">
                    <img class="card-img-top" src="https://loremflickr.com/120/120" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $film->name }}</h5>
                        <p class="card-text">{{ $film->description }}</p>
                        <a href="/films/{{ $film->slug }}" class="btn btn-primary">More Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
