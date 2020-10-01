@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <a href="{{ route('trashedAlbums.index') }}" class="btn btn-default border float-right">Trashed Albums</a>
</div>
<br>
@if(count($albums)>0)
@foreach ( $albums as $album )
<div class="card" style="width: 18rem;">
    <img class="card-img-top" style="height: 18rem;" src="{{ asset('storage/'.$album->cover_img) }}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ $album->name }}</h5>

        <div class="btn-group" role="group" aria-label="Basic example">
            @if (!$album->trashed())
            <a href="{{ route('albums.show',$album->id)}}" class="btn btn-primary border">Show </a>

            <a href="{{ route('albums.edit',$album->id)}}" class="btn btn-secondary border ">Edit </a>
            @else
            <a href="{{ route('trashed.restoreAlbum',$album->id)}}" class="btn btn-primary border">Restore </a>

            @endif



            <form action="{{  route('albums.destroy',$album->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger border border-success  ">
                   {{ $album->trashed()?'Delete':'Trash' }}
                </button>
            </form>








        </div>


    </div>
</div>

@endforeach
@endif

@endsection
