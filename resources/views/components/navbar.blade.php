<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fa-solid fa-earth-americas me-2"></i> {{$title}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('table')}}" target="_blank">
                        <i class="fa-solid fa-table me-2"></i> Table
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('map')}}">
                        <i class="fa-solid fa-signs-post me-2"></i> Maps
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-database"></i>
                        Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route("api.points")}}" target="_blank"><i class="fa-solid fa-location-dot"></i> Points</a></li>
                        <li><a class="dropdown-item" href="{{ route("api.polylines")}}" target="_blank"><i class="fa-brands fa-line"></i> Polylines</a></li>
                        <li><a class="dropdown-item" href="{{ route("api.polygons")}}" target="_blank"><i class="fa-solid fa-skull-crossbones"></i> Polygon</a></li>
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</nav>
