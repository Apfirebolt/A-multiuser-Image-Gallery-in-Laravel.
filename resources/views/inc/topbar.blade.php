<div class="top-bar">
    <div class="row">
        <div class="top-bar-left">
            <ul class="menu">
                <li class="menu-text">
                    PhotoShow
                </li>

                <li><a href="/PhotoGallery/public/dashboard">Dashboard</a></li>
                @if(Auth::check())
                    <li><a href="/PhotoGallery/public/logout">Logout</a></li>

                @else
                    <li><a href="/PhotoGallery/public/login">Login</a></li>
                @endif
                <li><a href="/PhotoGallery/public/register">Register</a></li>
                <li><a href="/PhotoGallery/public/albums/create">Create Album</a></li>
                <li><a href="/PhotoGallery/public/albums">View All Albums</a></li>
            </ul>
        </div>
    </div>
</div>