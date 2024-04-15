<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/addpict.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg"
        style="background-color: #F6F8FB;padding: 0px 30px;border:1px solid #ECECEC ; box-shadow: 0 4px 8px rgba(220, 220, 220, 0.25);">
        <div class="container-fluid">
            <img src="{{ asset('img/logo_pixsphere.png') }}" alt="Pixsphere" class="navbar-brand" width="128px">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"
                    style="font-weight: 600;display: flex;gap: 25px;font-size: 16px;margin-left: 50px;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/albums">Create</a>
                    </li>
                </ul>
                @auth
                <div class="dropdown" style="display: flex;align-items: center;gap: 8px;">
                    <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="display: flex;align-items: center;gap: 8px;border: none;">
                        <div class="img-prof"
                            style="display:flex;width:47px;height: 47px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                            <img src="{{ asset('profile_images/' . auth()->user()->photo_profil) }}" alt=""
                                style="width: 40px; height: 40px; border-radius: 50%;">
                        </div>
                        <p style="margin-top: 14px;cursor: pointer;">{{ auth()->user()->username}}</p>
                    </button>
                    <ul class="dropdown-menu">
                        <p style="font-size: 14px;font-weight: 600;padding: 10px;color: #959396;">Welcome
                            {{ auth()->user()->name}} !</p>
                        @endauth
                        <li><a class="dropdown-item"
                                style="display: flex;align-items: center;gap: 5px;font-size: 14px;font-weight: 400;"
                                href="/profile"><span class="material-symbols-outlined"
                                    style="color: #8fb4e8;font-size: 20px;">person</span> Profile</a></li>
                        <li><a class="dropdown-item"
                                style="display: flex;align-items: center;gap: 5px;font-size: 14px;font-weight: 400;"
                                href="/setting"><span class="material-symbols-outlined"
                                    style="color: #4bcd44;font-size: 20px;">settings</span> Setting</a></li>
                        <hr>
                        <li><a class="dropdown-item"
                                style="display: flex;align-items: center;gap: 5px;font-size: 14px;font-weight: 400;"
                                href="/logout"><span class="material-symbols-outlined"
                                    style="color: #d33e30;font-size: 18px;"> logout</span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="main">

        <div class="atas">
            @if ($album->cover)
            <img src="{{ asset($album->cover) }}" alt="">
            @else
            <img src="https://id-test-11.slatic.net/shop/186f07608a71497c6c35d88ef68a2b3b.jpeg" alt="Default Image">
            @endif
            <h5>{{ $album->name }}</h5>
        </div>
        <p>{{ $album->description }}</p>

        @php
        $totalPhoto = count($photos);
        @endphp
        <p class="info">{{ $totalPhoto }} Photos</p>
        <p class="tanggal">{{ $album->created_at->format('d/m/Y') }}</p>

        <div class="wrapper">
            @auth
            @if(auth()->user()->id == $album->user_id)
            <div class="styled-div" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <p>+</p>
            </div>
            @endif
            @endauth

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('photos.addtoalbum') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="photo">Select Photo:</label>
                                    <select name="photo_id" id="photo_id" class="form-control">
                                        <option value="">-- Select Photo --</option>
                                        @foreach ($foto as $photo)
                                        <option value="{{ $photo->id }}">{{ $photo->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">

                                <input type="hidden" name="user_id" value="1">

                                <br>
                                <button type="submit"
                                    class="w-full bg-blue-main text-white font-medium font-Mplus1 text-sm py-2 rounded">Add
                                    to Album</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- foreach folder -->
            @foreach($photos as $photo)
            @php
            $url = Storage::url('images/'.$photo->photo);
            $user = $photo->user;
            @endphp

            <div class="pictalbum">
                <img src="{{ url($url) }}" alt="">
                <div class="overlay">
                    <button class="delete">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</body>

</html>
