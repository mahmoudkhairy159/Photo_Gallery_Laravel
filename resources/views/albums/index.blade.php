@extends('layouts.app')
@section('content')
@if(count($albums)>0)
@foreach ( $albums as $album )
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{ asset('storage/'.$album->cover_img) }}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ $album->name }}</h5>

      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('albums.show',$album->id)}}" class="btn btn-primary border">Show </a>

        <a href="{{ route('albums.edit',$album->id)}}" class="btn btn-secondary border ">Edit </a>

        <form action="{{  route('albums.destroy',$album->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger border border-success  ">
                Delete
            </button>
        </form>








      </div>


    </div>
  </div>

@endforeach
@endif

@endsection
