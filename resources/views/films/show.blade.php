@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card w-100 mb-5">
                <img class="card-img-top align-self-center" src="https://loremflickr.com/120/120"
                     alt="{{ $film->name }}" style="max-width: 200px">
                <div class="card-body">
                    <h2 class="card-title">{{ $film->name }}</h2>
                    @if ($ratings>0)
                        <h5 class="card-subtitle text-info">Total Ratings <b>"{{ $ratings }}"</b> with an average of <b>"{{ $average }}
                                "</b></h5>
                    @else
                        <h5 class="card-subtitle text-warning">No ratings yet for this film</h5>
                    @endif
                    <p class="card-text">{{ $film->description }}</p>
                </div>
            </div>
        </div>

        @if (sizeof($comments) > 0)
            @foreach($comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $comment->owner->name }}</h4>
                        <p class="card-text">{{ $comment->body}}</p>
                    </div>
                </div>
            @endforeach
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @auth('web')
        <form class="form-horizontal w-100" method="POST" action="{{ route('comments', $film->slug) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="comment" class="col-4 col-form-label">Comment</label>
                <textarea id="comment" name="comment" cols="40" rows="5" class="form-control"
                          aria-describedby="commentHelpBlock" required="required"></textarea>
                <span id="commentHelpBlock" class="form-text text-muted">Post your comment here</span>
            </div>
            <div class="form-group">
                <div class="offset-5 col-md-8">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        @endauth
    </div>
    </div>
@endsection
