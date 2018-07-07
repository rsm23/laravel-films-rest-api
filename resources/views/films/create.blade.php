@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center">Create a new film</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal w-100" method="POST" action="{{ route('filmCreate') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-xs-4" for="name">Name</label>
                    <div class="col-xs-8">
                        <input id="name" name="name" placeholder="Name of the film" type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="control-label col-xs-4">Description</label>
                    <div class="col-xs-8">
                        <textarea id="description" name="description" cols="40" rows="5" class="form-control" aria-describedby="descriptionHelpBlock" required="required"></textarea>
                        <span id="descriptionHelpBlock" class="help-block">Description of the film</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="release_date" class="control-label col-xs-4">Release Date</label>
                    <div class="col-xs-8">
                        <input id="release_date" name="release_date" placeholder="Release Date" type="date" class="form-control" required="required" aria-describedby="release_dateHelpBlock">
                        <span id="release_dateHelpBlock" class="help-block">(mm-dd-yyyy)</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="control-label col-xs-4">Country</label>
                    <div class="col-xs-8">
                        <input id="country" name="country" placeholder="Country of the film" type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="control-label col-xs-4">Ticked Price</label>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <input id="price" name="price" placeholder="27.99" type="text" class="form-control" required="required" aria-describedby="priceHelpBlock">
                        </div>
                        <span id="priceHelpBlock" class="help-block">Price in USD</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="genre" class="control-label col-xs-4">Genre</label>
                    <div class="col-xs-8">
                        <select multiple="multiple" id="genre" name="genre[]" required="required" class="select form-control" aria-describedby="genreHelpBlock">
                            @foreach($genres as $genre)
                                <option value="{{$genre->id}}" {{ ($genre->id == old('genre') ? 'selected' : '') }}>{{ucfirst($genre->name)}}</option>
                            @endforeach
                        </select>
                        <span id="genreHelpBlock" class="help-block">You can select multiple genres</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="control-label col-xs-4">Photo of the film</label>
                    <div class="col-xs-8">
                        <input id="photo" name="photo" placeholder="Url of the film photo" type="text" class="form-control" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-offset-4 col-xs-8">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
