@extends('layouts.app')
@section('content')
<h3>Create Album</h3>
<div class="container">
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Album Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Album name">
        </div>
        <div class="form-group">
            <label for="name">Album cover image</label>
            <input type="file" class="form-control" name="cover_img">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>




@endsection
