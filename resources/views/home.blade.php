<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-color: #FFFFFF;padding: 0;margin: 0;">
    <nav class="navbar navbar-expand-lg"
        style="background-color: #F6F8FB;padding: 0px 30px;border:1px solid #ECECEC ; box-shadow: 0 4px 8px rgba(220, 220, 220, 0.25);">
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
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
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
                @endauth
            </div>
        </div>
    </nav>


    <div class="wrapperr">
        <div class="container-fluidd">
            <div class="search-container">
                <form action="{{ route('search') }}" method="POST" class="form-cari">
                    @csrf
                    <button class="btn-cari"><span class="material-symbols-outlined">search</span></button>
                    <input type="text" class="search-input" name="search" placeholder="Search..." autocomplete="off"
                        required>
                </form>
            </div>
        </div>
    </div>

    <div class="main">
        <!-- dropdown filter -->
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                style="border-radius: 15px;border: 1px solid #B8B8B8;margin-left: 10px;margin-bottom: 20px;">
                Filter
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item filter-option" href="#" data-filter="all">All</a></li>
                <li><a class="dropdown-item filter-option" href="#" data-filter="liked">Liked</a></li>
            </ul>
        </div>

        <div class="wrapper">
            @foreach ($photos as $img)

            @php
            $photo = Storage::url('images/'.$img->photo);
            $username = $img->user->username;
            $user_id = $img->user_id;
            $photo_profil = $img->user->photo_profil;
            $title = $img->title;
            $idimg = $img->id;
            $modalId = 'exampleModal_' . $img->id;
            $commentCount = $img->comments->count();
            $isLiked = in_array($img->id, $likedPhotoIds);
            @endphp

            <div class="box photo-box" data-liked="{{ $isLiked ? 'true' : 'false' }}">
                <div data-aos="fade-up">
                    <img src="{{ url($photo) }}" width="200px" height="100px" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}" class="zoom-effect">
                </div>
                <div class="info">
                    <a href="/profile/{{ $user_id }}">
                        <div class="name">
                            <img src="profile_images/{{ $photo_profil }}" alt="">
                            <p>{{ $username }}</p>
                        </div>
                    </a>
                    <div class="like">
                        <button class="btn-like" id="likeButton{{ $img->id }}" onclick="toggleLike({{ $img->id }})">
                            <span
                                class="material-symbols-outlined{{ in_array($img->id, $likedPhotoIds) ? ' text-danger' : '' }}"
                                id="likeIcon{{ $img->id }}">
                                favorite
                            </span>
                        </button>
                        <p class="like-count" id="likeCount{{ $img->id }}">{{ $img->likes->count() }}</p>
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


                        <button class="btn-komen">
                            <a href="{{ route('photo.detail', $idimg) }}"><span class="material-symbols-outlined">
                                    chat
                                </span></a>
                        </button>
                        <p class="comment-count">{{ $commentCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <br>
                            <a href="{{ route('photo.detail', $idimg) }}">
                                <img src="{{ url($photo) }}" alt="" class="img-modal">
                            </a>

                            <div class="infoy">
                                <div class="name">
                                    <a href="/profile/{{ $user_id }}">
                                        <img src="profile_images/{{ $photo_profil }}" alt="">
                                    </a>
                                    <p class="textusn"><span><a href="/profile/{{ $user_id }}">{{ $username }}
                                            </a></span> {{ ($title) }}</p>
                                </div>
                                @auth
                                @if(auth()->user()->role === 'admin')
                                <div class="delete-photo" data-id="{{ $idimg }}">
                                    <span class="material-symbols-outlined">delete</span>
                                </div>
                                @endif
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                function applyFilter(filter) {
                    const photoBoxes = document.querySelectorAll('.photo-box');
                    photoBoxes.forEach(function (box) {
                        const isLiked = box.dataset.liked === 'true';
                        if (filter === 'all') {
                            box.style.display = 'block';
                        } else if (filter === 'liked' && isLiked) {
                            box.style.display = 'block';
                        } else {
                            box.style.display = 'none';
                        }
                    });
                }

                const filterOptions = document.querySelectorAll('.filter-option');
                filterOptions.forEach(function (option) {
                    option.addEventListener('click', function (event) {
                        event.preventDefault();
                        const filter = event.target.dataset.filter;
                        applyFilter(filter);
                    });
                });
            });

        </script>
    </div>

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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>
