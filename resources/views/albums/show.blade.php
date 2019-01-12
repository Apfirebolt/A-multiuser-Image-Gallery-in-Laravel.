@extends('layouts.app')

@section('content')
    <h1>{{ $album->name }}</h1>
    <a href="/PhotoGallery/public/albums" class="button secondary"> Go Back </a>
    <a href="/PhotoGallery/public/photos/create/{{$album->id}}" class="button secondary"> Upload Photo to album </a>

    <hr>

        @foreach($album->photos as $photo)
            <div class="container grid-margin-x text-center">
                <div class="card" style="width: 800px;">
                    <div class="card-divider">
                        <h3 class="text-center">{{ $photo->title }}</h3>
                    </div>
                    <img class="thumbnail" src="http://localhost/PhotoGallery/storage/app/public/photos/{{$photo->album_id}}/{{ $photo->photo }}" data-name="{{ $photo->id }}" alt="{{$photo->title}}">
                    <div class="card-section">
                        <p>{{ $photo->description }}</p>
                        <div class="container text-center">
                            {!!Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete Photo', ['class' => 'button alert'])}}
                            {!!Form::close()!!}

                            <button class="btn btn-warning editBtn">Edit</button>
                            <button class="btn btn-warning animateBtn" value="{{ $photo->id }}">Animate</button>
                            <button class="btn btn-warning shareBtn">Share</button>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach



        @if(count($album->photos) == 0)
            <h3>No Photos to display for this album..</h3>
        @endif
@endsection

<style>
    img:hover {
        opacity: 0.7;
    }

    img {
        overflow: hidden;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        console.log('Document is loaded');

        // Hover effect
        $('.animateBtn').click(function() {
            let current_image = $(this).parent('.container').parent('.card-section').siblings('img');
            let h = current_image.height();
            let w = current_image.width();

            console.log(h, w);
            //current_image.fadeToggle(500);
            current_image.animate({
                height: '+=100px',
                width: '+=200px'
            }, 500, function() {
                current_image.animate({
                    height: h,
                    width: w
                }, 500)
            });
        });

        $('.shareBtn').one('click', function() {

            // Get the clicked image
            const current_image = $(this).parent('.container').parent('.card-section').siblings('img');

            const img_container = $(this).parent('.container').parent('.card-section');

            // Get the location of the clicked image
            const location = current_image.attr("src");

            // Get the id of the photo
            const photo_id = current_image.attr("data-name");

            // Converting template variables into JSON.
            const album = {!! json_encode($album->toArray(), JSON_HEX_TAG) !!};

            // Get the user id for the photo, we can use this to get user name
            const user_id = album['user_id'];

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "http://localhost/PhotoGallery/public/photos/share",
                data: {// change data to this object
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    photo_id: photo_id,
                    user_id: user_id,
                    location: location,
                },
                dataType: "text",
                success: function(data) {
                    img_container.append('<div class="container">' +
                        '<h3>Photo was shared successfully!</h3></div>');
                }
            });
        });
    });
</script>