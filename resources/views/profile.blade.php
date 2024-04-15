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
                            <img src="profile_images/{{ auth()->user()->photo_profil}}" alt="" style="width: 40px;height: 40px;border-radius: 50%;">
                        </div>
                        <p style="margin-top: 14px;cursor: pointer;">{{ auth()->user()->username}}</p>
                    </button>
                    <ul class="dropdown-menu">
                        <p style="font-size: 14px;font-weight: 600;padding: 10px;color: #959396;">Welcome {{ auth()->user()->name}} !</p>
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
        <h2>{{ auth()->user()->username}}</h2>
        <p>{{ auth()->user()->bio}}</p>
        <div class="text">
            <p>80 Followers </p>
            <p>80 Following </p>
            <p>0 Post</p>
        </div>

        <div class="button">
            @php
                $bio = auth()->user()->bio; // Mendapatkan bio pengguna
            @endphp

            @if($bio === null)
                <a href="/setting" class="btn btn rounded-pill fw-semibold" type="submit" style="background-color: #9AB2DB; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';" onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';">complete profile</a>
            @else
                <a href="/setting" class="btn btn rounded-pill fw-semibold" type="submit" style="background-color: #9AB2DB; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';" onmouseout="this.style.backgroundColor='#9AB2DB';this.style.color='#ffff';">Edit Profile</a>
            @endif

             <a href="" class="btn btn rounded-pill fw-semibold" type="submit" style="background-color: #F9F9F9; color: #1A1A1A; border: 2px solid #6C7195;" onmouseover="this.style.backgroundColor='#F0F3F6';" onmouseout="this.style.backgroundColor='#F9F9F9';this.style.color='#1A1A1A';">Deleted</a>
        </div>
        <br>
        <hr style="color: #a1a3b6;">
    </div>
@endauth
</body>

</html>