<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/album.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-color: #FFFFFF;padding: 0;margin: 0;">
    <nav class="navbar navbar-expand-lg" style="background-color: #FFFFFF;padding: 0px 30px;border:1px solid #ECECEC ;">
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
                        <a class="nav-link active" href="/albums">Create</a>
                    </li>
                </ul>
                @auth
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

    <div class="container-fluidd">
        <div class="search-container">
        </div>
    </div>


    <div class="main">
        <h5>Gallery</h5>
        <p>Gallery / Folder</p>
        <div class="wrapper">
            <!-- tombol modal add folder -->
            <a href="" class="new" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="img/newfolder.svg"
                    alt=""></a>
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
                                    <label for="description" class="description">Desc:</label>
                                    <input type="text" name="description" id="description" class="form-control" required
                                        class="">
                                </div><br>
                                @if (!$photos->isEmpty())
                                    <div class="form-group">
                                        <label>Select Photos:</label>
                                        <ul>
                                            @foreach ($photos as $photo)
                                            <li>
                                                <input type="checkbox" id="cb{{ $photo->id }}" name="photo_ids[]"
                                                    value="{{ $photo->id }}" />
                                                <label for="cb{{ $photo->id }}" class="label"><img
                                                        src="{{ Storage::url('images/'.$photo->photo) }}" /></label>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <br><br>
                                <button type="submit" class="btn btn-primary"
                                    style="background-color:#A6B0D8;border:none">Create
                                    Album</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- foreach folder -->
            @foreach ($albums as $album)
            {{-- @php $path = Storage::url('images/'.$img->path); @endphp --}}
            <div class="album-wrapper">
                <a href="{{ route('albums.show', $album->id) }}" class="folder">
                    <div class="menu">
                        <div class="kiri">
                            @if ($album->cover)
                            <img src="{{ $album->cover }}" alt="">
                            @else
                            <img src="https://id-test-11.slatic.net/shop/186f07608a71497c6c35d88ef68a2b3b.jpeg"
                                alt="Default Image">
                            @endif
                            <p>{{$album->name}}</p>
                        </div>
                    </div>
                </a>
                <div class="delete-icon" data-id="{{ $album->id }}">
                    <span class="material-symbols-outlined">delete</span>
                </div>

            </div>
            @endforeach
        </div>

        <p class="text-img">Gallery / Image</p>
        <div class="wrapper1">
            <!-- tombol add image -->
            <a href="/photos-create" class="add">+</a>

            <!-- foreach image -->
            @foreach ($photos as $img)
            @php $photo = Storage::url('images/'.$img->photo); @endphp
            <div class="image-container">
                <a href="/photos/{{ $img->id }}" class="images">
                    <img src="{{ url($photo) }}" alt="">
                </a>
                <div class="overlay">
                    <p class="name-text">{{ $img->title }}</p>
                    <div class="icon">
                        <a href="{{ route('photos.edit', $img->id) }}">
                            <span class="material-symbols-outlined">edit</span>
                        </a>

                        <a class="delete-photo" data-id="{{ $img->id }}">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <script>
        document.getElementById('file-input').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('uploaded-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-icon');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const albumId = this.getAttribute('data-id'); // Mengambil ID album

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete route
                            window.location.href =
                                `/albums/delete/${albumId}`; // Mengarahkan ke route delete dengan ID album
                        }
                    });
                });
            });
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-photo');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const photoId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to delete route
                            window.location.href = `/photos/delete/${photoId}`;
                        }
                    });
                });
            });
        });

    </script>
<div class="footer">
        <div class="atas">
            <img src="img/logo_pixsphere.png" alt="" class="logo-pixsphere">
            <div class="link">
                <ul>
                    <li>For designers</li>
                    <li>Hire talent</li>
                    <li>Inspriration</li>
                    <li>Advertising</li>
                    <li>Blog</li>
                    <li>About</li>
                    <li>Careers</li>
                    <li>Support</li>
                </ul>
            </div>
            <img src="img/Rectangle 122.png" alt="" class="logo-sosmed">
        </div>
        <div class="bawahh">
            <div class="linkk">
                <ul>
                    <li>@2024 pixsphere</li>
                    <li>Terms</li>
                    <li>Privacy</li>
                    <li>Cookies</li>
                </ul>
            </div>
            <div class="linkk">
                <ul>
                    <li>Job</li>
                    <li>Designers</li>
                    <li>Tag</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
