<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/postimg.css">
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
                    @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/report">Report</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="/albums">Create</a>
                    </li>
                    @endif
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
        <h5>Image</h5>
        <p>Post an image</p>

        <form id="uploadForm" method="POST" action="{{ route('photos.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-container">
                <div class="image-preview" id="imagePreview">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div><br>
                <div class="form-group">
                    <label for="image" class="custom-file-upload">Upload an Image</label>
                    <input type="file" id="image" name="photo" id="imageInput" hidden required>
                </div>
            </div>
            <div class="input-text">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description">
                </div>

                <br>
                @if (!$albums->isEmpty())
                <div class="form-group">
                    <label>Add to Album (optional):</label>
                    <div>
                        @foreach ($albums as $album)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="album_id" id="album{{ $album->id }}"
                                value="{{ $album->id }}">
                            <label class="form-check-label" for="album{{ $album->id }}">
                                {{ $album->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif



                <div class="button">
                    <button class="btn btn rounded-pill fw-semibold" type="submit"
                        style="background-color: #9AB2DB; color: #ffff;"
                        onmouseover="this.style.backgroundColor='#B9CCEC';"
                        onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';">Post Image</button>

                    <button class="btn btn rounded-pill fw-semibold" type="button"
                        style="background-color: #F9F9F9; color: #1A1A1A; border: 2px solid #6C7195;"
                        onmouseover="this.style.backgroundColor='#F0F3F6';"
                        onmouseout="this.style.backgroundColor='#F9F9F9';this.style.color='#1A1A1A';"><a
                            href="/photos-create" style="color: #1A1A1A;text-decoration:none;">Cancel</a></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("image").addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const imagePreview = document.getElementById("imagePreview");
                    imagePreview.innerHTML = `<img src="${event.target.result}" alt="Image Preview">`;
                };
                reader.readAsDataURL(file);
            } else {
                const imagePreview = document.getElementById("imagePreview");
                imagePreview.innerHTML = '<i class="fas fa-cloud-upload-alt"></i>';
            }
        });

    </script>
</body>

</html>
