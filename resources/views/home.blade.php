@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="container">
                        <h2>Here are all the shared photos</h2>

                        @foreach($photos as $photo)
                            <div class="container grid-margin-x text-center">
                                <div class="card" style="width: 800px;">
                                    <img class="thumbnail" src="{{ $photo->location }}"  alt="Image not available">
                                    <div class="card-section">
                                        <p> Shared by {{ $photo->user_id }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
