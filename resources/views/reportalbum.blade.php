<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums Report</title>
    <!-- Tambahkan link CSS Bootstrap di sini -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>{{ $title }}</h1>
        <p>{{ $date }}</p>
        <div class="album-wrapper">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>Album Name</th>
                        <th>Description</th>
                        <th>By</th>
                        <th>Photo</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($albums as $album)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $album->name }}</td>
                        <td>{{ $album->description }}</td>
                        <td>@ {{ $album->user->username }}</td>
                        <td>
                            @foreach($album->photos as $photo)
                            <p>{{ $photo->photo }}</p>
                            @endforeach
                        </td>
                        <td>{{ $album->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>no</th>
                        <th>Album Name</th>
                        <th>Description</th>
                        <th>By</th>
                        <th>Photo</th>
                        <th>Created</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
