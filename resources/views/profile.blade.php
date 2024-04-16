<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    @auth
    <nav class="navbar navbar-expand-lg" style="background-color: #F6F8FB;padding: 0px 30px;border:1px solid #ECECEC ;">
        <div class="container-fluid">
            <img src="img/logo_pixsphere.png" alt="Pixsphere" class="navbar-brand" width="128px">
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
                <div class="dropdown" style="display: flex;align-items: center;gap: 8px;">
                    <button class="btn btn-white dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="display: flex;align-items: center;gap: 8px;border: none;">
                        <div class="img-prof"
                            style="display:flex;width:47px;height: 47px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                            <img src="profile_images/{{ auth()->user()->photo_profil}}" alt=""
                                style="width: 40px;height: 40px;border-radius: 50%;">
                        </div>
                        <p style="margin-top: 14px;cursor: pointer;">{{ auth()->user()->username}}</p>
                    </button>
                    <ul class="dropdown-menu">
                        <p style="font-size: 14px;font-weight: 600;padding: 10px;color: #959396;">Welcome
                            {{ auth()->user()->name}} !</p>
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

    <div class="container-fluidd">
        <div class="img">
            <img src="profile_images/{{ auth()->user()->photo_profil}}" alt="">
        </div>
    </div>

    <div class="main">
        <h2>{{ $user->username }}</h2>
        <p class="name">{{ $user->name }}</p>
        <p class="bio">{{ $user->bio }}</p>
        <div class="text">
            <p data-bs-toggle="modal" data-bs-target="#followerModal">{{ $followerCount }} Followers </p>
            <p data-bs-toggle="modal" data-bs-target="#followingModal ">{{ $followingCount }} Following</p>
            <p>{{ $photoCount }} Post</p>
        </div>
        <div class="button">
            @php
            $bio = auth()->user()->bio; // Mendapatkan bio pengguna
            @endphp

            @if($bio === null)
            <a href="/setting" class="btn btn rounded-pill fw-semibold" type="submit"
                style="background-color: #9AB2DB; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';"
                onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';">complete profile</a>
            @else
            <a href="/setting" class="btn btn rounded-pill fw-semibold" type="submit"
                style="background-color: #9AB2DB; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';"
                onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';">Edit Profile</a>
            @endif

            <a href="" class="btn btn rounded-pill fw-semibold" type="submit"
                style="background-color: #F9F9F9; color: #1A1A1A; border: 2px solid #6C7195;"
                onmouseover="this.style.backgroundColor='#F0F3F6';"
                onmouseout="this.style.backgroundColor='#F9F9F9';this.style.color='#1A1A1A';">Deleted</a>
        </div>
        <br>
        <div class="buttonn">
            <div class="btn-active"><button id="imageBtn">Image</button></div>
            <div class=""><button id="AlbumBtn">Album</button></div>
        </div>
        <hr style="color: #a1a3b6;">
        <div class="photo-wrapper">
            <a href="/photos-create" class="add">+</a>
            @foreach ($photos as $img)
            @php $photo = Storage::url('images/'.$img->photo); @endphp
            <a href="/photos/{{ $img->id }}" class="images"><img src="{{ url($photo) }}" alt=""></a>
            @endforeach
        </div>
        <div class="album-wrapper">
            <a href="" class="new" data-bs-toggle="modal" data-bs-target="#exampleModal"><img
                    src="{{ asset('img/newfolder.svg') }}" alt=""></a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Folder</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('albums.create') }}" enctype="multipart/form-data"
                                class="flex gap-2 flex-col">
                                @csrf
                                <p class="textcover"> cover album : </p>
                                <div class="upload">
                                    <img id="uploaded-image"
                                        src="https://cdn.pixabay.com/photo/2017/02/07/02/16/cloud-2044823_1280.png"
                                        alt="">
                                    <div class="round">
                                        <input type="file" id="file-input" name="cover">
                                        <p>+</p>
                                    </div>
                                </div><br><br>
                                <div class="form-group">
                                    <label for="name" class="">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control" required class="">
                                </div><br>
                                <div class="form-group">
                                    <label for="description" class="">Desc:</label>
                                    <input type="text" name="description" id="description" class="form-control" required
                                        class="">
                                </div><br>
                                <div class="form-group">
                                    <label for="photo">Select Photos:</label>
                                    <select name="photo_ids[]" id="photo_ids" class="form-control w-80" multiple>
                                        <option value="">-- Select Photos --</option>
                                        @foreach ($photos as $photo)
                                        <option value="{{ $photo->id }}"
                                            data-photo-url="{{ Storage::url('images/'.$photo->photo) }}">
                                            {{ $photo->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="selectedPhotos"></div>

                                <script>
                                    document.getElementById('photo_ids').addEventListener('change', function () {
                                        var selectedPhotos = this.selectedOptions;
                                        var selectedPhotosHtml = '';
                                        for (var i = 0; i < selectedPhotos.length; i++) {
                                            var photoUrl = selectedPhotos[i].getAttribute('data-photo-url');
                                            var photoTitle = selectedPhotos[i].textContent;
                                            selectedPhotosHtml += '<div><img src="' + photoUrl + '" alt="' +
                                                photoTitle + '" width="200px"></div>';
                                        }
                                        document.getElementById('selectedPhotos').innerHTML =
                                            selectedPhotosHtml;
                                    });

                                </script>


                                <br><br>
                                <button type="submit" class="btn btn-primary"
                                    style="background-color:#A6B0D8;border:none">Create
                                    Album</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($albums as $album)
            {{-- @php $path = Storage::url('images/'.$img->path); @endphp --}}
            <a href="{{ route('albums.show', $album->id) }}" class="folder">
                <div class="menu">
                    <div class="kiri">
                        @if ($album->cover)
                        <img src="{{ asset($album->cover) }}" alt="">
                        @else
                        <img src="https://id-test-11.slatic.net/shop/186f07608a71497c6c35d88ef68a2b3b.jpeg"
                            alt="Default Image">
                        @endif
                        <p>{{$album->name}}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const imageBtn = document.getElementById("imageBtn");
                const albumBtn = document.getElementById("AlbumBtn");
                const photoWrapper = document.querySelector(".photo-wrapper");
                const albumWrapper = document.querySelector(".album-wrapper");

                photoWrapper.style.display = "flex";
                albumWrapper.style.display = "none";

                imageBtn.addEventListener("click", function () {
                    photoWrapper.style.display = "flex";
                    albumWrapper.style.display = "none";

                    imageBtn.parentElement.classList.add("btn-active");
                    albumBtn.parentElement.classList.remove("btn-active");
                });

                albumBtn.addEventListener("click", function () {
                    photoWrapper.style.display = "none";
                    albumWrapper.style.display = "flex";

                    albumBtn.parentElement.classList.add("btn-active");
                    imageBtn.parentElement.classList.remove("btn-active");
                });
            });

        </script>
    </div>

    <!-- Modal followers -->
    <div class="modal fade" id="followerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Followers :</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($followerUsers->isEmpty())
                    <p>No followers here</p>
                    @else
                    @foreach($followerUsers as $follower)
                    <a href="/profile/{{ $follower->id }}">
                        <button class="btn btn-white" type="button"
                            style="display: flex;align-items: center;gap: 8px;border: none;">
                            <div class="img-prof"
                                style="display:flex;width:47px;height: 47px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                                <img src="{{ asset('profile_images/' . $follower->photo_profil) }}" alt=""
                                    style="width: 40px; height: 40px; border-radius: 50%;">
                            </div>
                            <p style="margin-top: 14px;cursor: pointer;">{{ $follower->username }}</p>
                        </button>
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal following -->
    <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Following :</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        @if($followingUsers->isEmpty())
                        <p>No following</p>
                        @else
                        @foreach($followingUsers as $following)
                        <a href="/profile/{{ $following->id }}">
                            <button class="btn btn-white" type="button"
                                style="display: flex;align-items: center;gap: 8px;border: none;">
                                <div class="img-prof"
                                    style="display:flex;width:47px;height: 47px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                                    <img src="{{ asset('profile_images/' . $following->photo_profil) }}" alt=""
                                        style="width: 40px; height: 40px; border-radius: 50%;">
                                </div>
                                <p style="margin-top: 14px;cursor: pointer;">{{ $following->username }}</p>
                            </button>
                        </a>
                        @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endauth
</body>

</html>
