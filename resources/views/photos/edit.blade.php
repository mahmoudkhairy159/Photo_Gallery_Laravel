@extends('layouts.app')
@section('content')
<h3>Edit photo</h3>
<div class="container">
    <form action="{{ route('photos.update', $photo->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="title">Photo Title</label>
            <input type="text" class="form-control" name="title" value="{{ $photo->title}}">
        </div>
        <div class="form-group">
            <img src="{{ asset('storage/'.$photo->photo) }}" class="card-img-top" style="width: 18rem;" >
        </div>
        <div class="form-group">
            <label for="name">Upload Photo</label>
            <input type="file" class="form-control" name="photo">
        </div>

        <input type="text" name="album_id" value="{{ $photo->album_id }}" hidden>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




@endsection
