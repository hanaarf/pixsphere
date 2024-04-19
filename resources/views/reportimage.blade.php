<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Report</title>
    <!-- Tambahkan link CSS Bootstrap di sini -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <div class="album-wrapper">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>By</th>
                    <th>Image</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $photo->title }}</td>
                    <td>{{ $photo->description }}</td>
                    <td>@ {{ $photo->user->name }} </td>
                    <td><p>{{ $photo->photo }}</p></td>
                    <td>{{ $photo->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>By</th>
                    <th>Image</th>
                    <th>Created</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
