<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link rel="stylesheet" href="css/report.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
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
                    @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link active" href="/report">Report</a>
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
    
    <div class="atass">
        <h4>Report</h4>
        <p class="text">User Posting Activity</p>
    </div>
    <div class="main">
        <div class="chartCard">
            <div class="chartBox">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <div class="button">
        <div class="btn-active"><button id="AlbumBtn">Album</button></div>
        <div class=""><button id="ImageBtn">Image</button></div>
    </div>
    <div class="hr">
        <hr>
    </div>
    <div class="atass">
    </div>

    <div class="album-wrapper">
        <div class="table">
            <div class="main-table">
            <a href="/exportalbum" class="btn btn rounded-pill fw-semibold" type="submit"
                style="background-color: #4E6181; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';"
                onmouseout="this.style.backgroundColor='#4E6181';this.style.color='#ffff';">Export pdf</a>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Album Name</th>
                        <th>Desc</th>
                        <th>By</th>
                        <th>Photo </th>
                        <th>Created </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->description }}</td>
                        <td><img src="{{ asset('profile_images/'.$album->user->photo_profil) }}" alt="{{ $album->user->photo_profil }}" style="width:20px;height:20px;border-radius:10px;border:1px solid black"> @ {{ $album->user->name }} </td>
                        <td>
                        @foreach($album->photos as $photo)
                            <img src="{{ url(Storage::url('images/' . $photo->photo)) }}" alt="{{ $photo->title }}" height="50px">
                        @endforeach
                        </td>
                        <td>{{ $album->created_at->format('Y-m-d')  }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>no</th>
                        <th>Album Name</th>
                        <th>Desc</th>
                        <th>By</th>
                        <th>Photo </th>
                        <th>Created </th>  
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>

    <div class="image-wrapper" style="display:none;">
        <div class="table">
            <div class="main-table">
            <a href="/exportimage" class="btn btn rounded-pill fw-semibold" type="submit"
                style="background-color: #4E6181; color: #ffff;" onmouseover="this.style.backgroundColor='#B9CCEC';"
                onmouseout="this.style.backgroundColor='#4E6181';this.style.color='#ffff';">Export Pdf</a>
            <table id="example1" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Title</th>
                        <th>Desc </th>
                        <th>By</th>
                        <th>Image</th>
                        <th>Created </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($photos as $photo)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $photo->title }}</td>
                        <td>{{ $photo->description }}</td>
                        <td><img src="{{ asset('profile_images/'.$photo->user->photo_profil) }}" alt="{{ $photo->user->photo_profil }}" style="width:20px;height:20px;border-radius:10px;border:1px solid black"> @ {{ $photo->user->name }} </td>
                        <td><img src="{{ asset('storage/images/' . $photo->photo) }}" alt="{{ $photo->title }}" height="50px"></td>
                        <td>{{ $photo->created_at->format('Y-m-d')  }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>no</th>
                        <th>Title</th>
                        <th>Desc </th>
                        <th>By</th>
                        <th>Image</th>
                        <th>Created </th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
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
        const photoCounts = {!! json_encode($photoCounts) !!};
        const albumCounts = {!! json_encode($albumCounts) !!};

        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'],
            datasets: [{
                    label: 'Image',
                    data: photoCounts, 
                    backgroundColor: [
                        '#EFEFEF',
                    ],
                    borderColor: [
                        '#ACC3EA',
                    ],
                    tension: 0.4
                },
                {
                    label: 'Album',
                    data: albumCounts,
                    backgroundColor: [
                        '#EFEFEF'
                    ],
                    borderColor: [
                        '#4E6181'
                    ],
                    tension: 0.4,
                }
            ]
        };

        const config = {
            type: 'line',
            data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        const chartVersion = document.getElementById('chartVersion');
        chartVersion.innerText = Chart.version;
    </script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        new DataTable('#example1');
    </script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    </script> -->

    <script>
    $(document).ready(function() {
        // Ketika tombol Album diklik
        $('#AlbumBtn').click(function() {
            // Mengaktifkan tombol Album dan menonaktifkan tombol Image
            $('#AlbumBtn').parent().addClass('btn-active');
            $('#ImageBtn').parent().removeClass('btn-active');
            // Menampilkan album-wrapper
            $('.album-wrapper').show();
            // Menyembunyikan image-wrapper
            $('.image-wrapper').hide();
        });

        // Ketika tombol Image diklik
        $('#ImageBtn').click(function() {
            // Mengaktifkan tombol Image dan menonaktifkan tombol Album
            $('#ImageBtn').parent().addClass('btn-active');
            $('#AlbumBtn').parent().removeClass('btn-active');
            // Menampilkan image-wrapper
            $('.image-wrapper').show();
            // Menyembunyikan album-wrapper
            $('.album-wrapper').hide();
        });
    });
</script>
    
</body>

</html>
