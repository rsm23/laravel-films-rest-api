@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="card">
                    <img class="card-img-top align-self-center" src="https://loremflickr.com/120/120" alt="{{ $film->name }}" style="max-width: 200px">
                    <div class="card-body">
                        <h2 class="card-title">{{ $film->name }}</h2>
                        @if ($ratings>0)
                            <h5 class="card-subtitle text-info">Total Ratings <b>"{{ $ratings }}"</b> with an average of <b>"{{ $average }}"</b></h5>
                        @endif
                        <p class="card-text">{{ $film->description }}</p>
                    </div>
                </div>
        </div>
    </div>
@endsection
