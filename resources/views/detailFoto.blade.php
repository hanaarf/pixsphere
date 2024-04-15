<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/picture.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-color: #F6F8FB;padding: 0;margin: 0;">
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

    @foreach ($photos as $img)
    @php
    $isLiked = in_array($img->id, $likedPhotoIds);
    @endphp
    @endforeach
    <div class="main">
        <div class="img">
            <div class="name">
                <div class="img-prof"
                    style="display:flex;width:47px;height: 47px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                    <img src="{{ asset('profile_images/' . $photo->user->photo_profil) }}" alt=""
                        style="width: 40px;height: 40px;border-radius: 50%;">
                </div>
                <p class="text">{{ $photo->user->username }}</p>
            </div>
            <div class="box-img">
                <img src="{{ asset('storage/images/' . $photo->photo) }}" alt="" class="pict">
            </div>
            <div class="like">
                <button class="btn-like" id="likeButton{{ $photo->id }}" onclick="toggleLike({{ $photo->id }})">
                    <span
                        class="material-symbols-outlined{{ in_array($photo->id, $likedPhotoIds) ? ' text-danger' : '' }}"
                        id="likeIcon{{ $photo->id }}">
                        favorite
                    </span>
                </button>
                <p class="like-count" id="likeCount{{ $photo->id }}">{{ $photo->likes->count() }}</p>
                <script>
                    function toggleLike(photoId) {
                        fetch(`/photos/${photoId}/like`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({}),
                            })
                            .then(response => response.json())
                            .then(data => {
                                const likeIcon = document.getElementById('likeIcon' + photoId);
                                const likeCount = document.getElementById('likeCount' + photoId);
                                if (data.isLiked) {
                                    likeIcon.classList.add('text-danger');
                                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                                } else {
                                    likeIcon.classList.remove('text-danger');
                                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }

                </script>

                <span class="material-symbols-outlined">
                    chat
                </span>
                <p class="comment-count">{{ $comments->count() }}</p>
            </div>
            <p class="text-name"><span>{{ $photo->user->username }} </span>{{ $photo->title }}</p>
        </div>
        <div class="vertical-line"></div>
        <div class="komen">
            <p class="jdl-komen">Coment</p>
            <div class="box-komen">
                @foreach ($comments as $comment)
                <div class="isi-komen">
                    <div class="img-prof"
                        style="display:flex;width:40px;height: 40px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                        <img src="{{ asset('profile_images/' . $comment->user->photo_profil) }}" alt=""
                            style="width: 35px;height: 35px;border-radius: 50%;">
                    </div>
                    <p class="text-komen"><span>{{ $comment->user->username }}</span> {{ $comment->comment }}</p>
                </div>
                @endforeach

            </div>

            <div class="send-komen">
                <div class="img-prof"
                    style="display:flex;width:55px;height: 55px;border-radius: 50%;padding: 4px;border: 1px solid #332C54;justify-content: center;align-items: center;">
                    <img src="{{ asset('profile_images/' . auth()->user()->photo_profil) }}" alt=""
                        style="width: 49px;height: 49px;border-radius: 50%;">
                </div>
                <form action="{{ route('comments.store') }}" method="POST" class="comment-form">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                    <div class="input-container">
                        <input type="text" name="comment" placeholder="Add comment" class="comment-input">
                        <button type="submit" class="material-symbols-outlined send-icon"
                            aria-label="Send comment">send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

</body>

</html>
