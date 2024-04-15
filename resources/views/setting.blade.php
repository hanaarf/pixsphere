<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/setting.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: #F9F9F9;padding: 0;margin: 0;">
    @if($message = Session::get('success'))
    <div class="alert success">
        <span class="closebtn">&times;</span>
        <strong>Success!</strong> {{ $message }}
    </div>
    @endif

    @auth
    <nav class="navbar navbar-expand-lg"
        style="background-color: #F6F8FB;padding: 0px 30px;border:1px solid #ECECEC ;">
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
    </div>

    <div class="main">
        <h2>Edit Profile</h2>
        <form action="/UpdateProfile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="img">
                <div class="img-text">
                    <div class="upload">
                        <img id="uploaded-image" src="profile_images/{{ auth()->user()->photo_profil}}" alt=""
                            style="border-radius: 50%;width: 55px;height: 55px;">
                        <div class="round">
                            <input type="file" id="file-input" name="photo_profil">
                            <i class="fa fa-camera" style="color: #fff;font-size: 11px;"></i>
                        </div>
                    </div>
                </div>
            </div><br><br>

            <div class="form-group">
                <label for="nama">Bio</label>
                <input type="text" id="bio" name="bio" value="{{ auth()->user()->bio }}">
            </div>
            <div class="form-group">
                <label for="umur">Name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}">
            </div>

            <br>
            <div class="button">
                <button type="submit" class="btn btn rounded-pill fw-semibold" type="submit"
                    style="background-color: #9AB2DB; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';"
                    onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';"> Save Update</button>

                <button type="button" onclick="window.location.reload();" class="btn btn rounded-pill fw-semibold"
                    style="background-color: #F9F9F9; color: #1A1A1A; border: 2px solid #6C7195;"
                    onmouseover="this.style.backgroundColor='#F0F3F6';"
                    onmouseout="this.style.backgroundColor='#F9F9F9';this.style.color='#1A1A1A';">Cancel</button>

            </div>
        </form>
    </div>
    @endauth

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
        var close = document.getElementsByClassName("closebtn");
        var i;

        for (i = 0; i < close.length; i++) {
            close[i].onclick = function () {
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function () {
                    div.style.display = "none";
                }, 600);
            }
        }

    </script>
</body>

</html>
