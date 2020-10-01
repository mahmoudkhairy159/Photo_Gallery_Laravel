@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <a href="{{ route('trashedPhotos.index',$album->id) }}" class="btn btn-default border float-right">Trashed
        Photos</a>
        <h3 class="d-block">{{ $album->name }}</h3>
        <a href="{{ route('albums.index') }}" class="btn btn-secondary">Go back</a>
        <a href="{{ route('addPhoto',$album->id) }}" class="btn btn-primary">Upload Photos To Album</a>
</div>
    @if (count($album->photos)>0)
    @foreach ($album->photos as $photo)
    <div class="col-sm-3">
    <div class="card h-200 "  >
        <img class="card-img-top " style="height: 60%" src="{{ asset('storage/'.$photo->photo) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $photo->title }}</h5>
            @if (!$photo->trashed())
            <a href="{{  route('photos.edit',$photo->id)}}" class="btn btn-primary">Update photo</a>
            @else
            <a href="{{ route('trashed.restorePhoto',$photo->id)}}" class="btn btn-primary border">Restore </a>

            @endif
            <div class="float-right ">
                <form action="{{  route('photos.destroy',$photo->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border border-success  ">
                        {{ $photo->trashed()?'Delete':'Trash' }}

                    </button>
                </form>
            </div>


        </div>
    </div></div>

    @endforeach

    @endif





@endsection
