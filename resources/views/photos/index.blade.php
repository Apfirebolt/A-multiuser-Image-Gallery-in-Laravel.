@extends('layouts.app')

@section('content')
    <h2>Photos section homepage</h2>

    @foreach($photos as $photo)
    <h4>{{ $photo->title  }}</h4>
        <p>{{ $photo->photo }}</p>
    @endforeach
@endsection