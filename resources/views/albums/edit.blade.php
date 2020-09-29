@extends('layouts.app')
@section('content')
<h3>Edit Album</h3>
<div class="container">
    <form action="{{ route('albums.update', $album->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="title">Album Name</label>
            <input type="text" class="form-control" name="name" value="{{ $album->name}}">
        </div>
        <div class="form-group">
            <img src="{{ asset('storage/'.$album->cover_img) }}" class="card-img-top" style="width: 18rem;" >
        </div>
        <div class="form-group">
            <label for="name">Upload cover Image</label>
            <input type="file" class="form-control" name="cover_img">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




@endsection
