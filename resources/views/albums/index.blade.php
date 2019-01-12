@extends('layouts.app')

@section('content')
    <h2 class="text-center">Welcome, {{ Auth::user()->name }}</h2>
    @if(count($albums) > 0)
        <div id="albums">
            @foreach($albums as $album)

                <a href="/PhotoGallery/public/albums/{{$album->id}}">
                    <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                </a>
                <br>
                <h4 class="text-center">{{$album->name}}</h4>
            @endforeach

        </div>
    @else
        <p>No Albums To Display</p>
    @endif

@endsection
