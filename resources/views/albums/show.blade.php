@extends('layouts.app')
@section('content')
<div class="container">

    <h3 class="d-block">{{ $album->name }}</h3>
    <a href="{{ route('albums.index') }}" class="btn btn-secondary">Go back</a>
    <a href="{{ route('addPhoto',$album->id) }}" class="btn btn-primary">Upload Photos To Album</a>

    @if (count($album->photos)>0)
    @foreach ($album->photos as $photo)
    <div class="card" style="width: 25rem;">
        <img class="card-img-top" src="{{ asset('storage/'.$photo->photo) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $photo->title }}</h5>
            <a href="{{  route('photos.edit',$photo->id)}}" class="btn btn-primary">Update photo</a>

            <div class="float-right ">
                <form action="{{  route('photos.destroy',$photo->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border border-success  ">
                        Delete Photo
                    </button>
                </form>
            </div>


        </div>
    </div>

    @endforeach

    @endif
</div>





@endsection
