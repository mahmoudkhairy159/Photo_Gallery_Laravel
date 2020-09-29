@extends('layouts.app')
@section('content')
<h3>Add photo</h3>
<div class="container">
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Photo Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter Photo's title">
        </div>
        <div class="form-group">
            <label for="name">Upload Photo</label>
            <input type="file" class="form-control" name="photo">
        </div>
        <input type="text" name="album_id" value="{{ $album_id }}" hidden>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




@endsection
