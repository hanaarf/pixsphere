<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <body>

        <div class="font-sans flex flex-row py-3 px-3 items-center justify-evenly">
            <div class="w-fit border border-gray-500 border-opacity-30 p-2 px-3 rounded">
                <p class="font-medium">Create Album</p>
                <form method="POST" action="{{ route('albums.create') }}" enctype="multipart/form-data" class="flex gap-2 flex-col">
                    @csrf
                
                    <div class="form-group">
                        <label for="album_name" class="">Album Name:</label>
                        <input type="text" name="album_name" id="album_name" class="form-control" required class="">
                    </div>
                
                    <div class="form-group">
                        <label for="photo">Select Photo:</label>
                        <select name="photo_id" id="photo_id" class="form-control w-80">
                            <option value="">-- Select Photo --</option>
                            @foreach ($photos as $photo)
                                <option value="{{ $photo->id }}">{{ $photo->id }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <input type="hidden" name="user_id" value="1">
                
                    <button type="submit" class="w-full bg-blue-main text-white font-medium font-Mplus1 text-sm py-2 rounded">Create Album</button>
                </form>
            </div>
    
            <div class="w-fit border border-gray-500 border-opacity-30 p-2 px-3 rounded">
                <p class="font-medium">Upload Photo</p>
                <form method="POST" action="{{ route('photos.upload') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group mt-3">
                        <input type="file" name="photo" id="photo" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label for="album_id">Select Album (optional):</label>
                        <select name="album_id" id="album_id" class="form-control">
                            <option value="">-- Select Album --</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="hidden" name="user_id" value="1">
    
                    <button type="submit" class="w-full bg-blue-main text-white font-medium font-Mplus1 text-sm py-2 rounded">Upload Photo</button>
                </form>
            </div>
    
            <div class="w-fit border border-gray-500 border-opacity-30 p-2 px-3 rounded">
                <p class="font-medium">Add to Album</p>
                <form method="POST" action="{{ route('photos.addtoalbum') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label for="photo">Select Photo:</label>
                        <select name="photo_id" id="photo_id" class="form-control">
                            <option value="">-- Select Photo --</option>
                            @foreach ($photos as $photo)
                                <option value="{{ $photo->id }}">{{ $photo->id }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="album_id">Select Album:</label>
                        <select name="album_id" id="album_id" class="form-control w-80">
                            <option value="">-- Select Album --</option>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="hidden" name="user_id" value="1">
    
                    <button type="submit" class="w-full bg-blue-main text-white font-medium font-Mplus1 text-sm py-2 rounded">Add to Album</button>
                </form>
            </div>
        </div>

        <div class="flex flex-row">
            <div class="col-md-6">
                <h3 class="font-medium mb-2">Daftar Album</h3>
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-xs">Nama</th>
                        <th class="text-xs">Description</th>
                        <th class="text-xs">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($albums as $album)
                      {{-- @php $path = Storage::url('images/'.$img->path); @endphp --}}
                          <tr>
                            <td>{{$album->name}}</td>
                            <td>{{ $album->description ?? 'tdk ada'}}</td>
                            <td><a href={{ route('albums.show', $album->id) }}>Check</a></td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>

            <div class="col-md-6">
                <h3 class="font-medium mb-2">Daftar Gambar</h3>
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-xs">Gambar</th>
                        <th class="text-xs">Path</th>
                        <th class="text-xs">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($photos as $img)
                      @php $photo = Storage::url('images/'.$img->photo); @endphp
                          <tr>
                            <td><img src="{{ url($photo) }}" width="200px" height="100px"></td>
                            <td>{{ $photo }}</td>
                            <td><a href="{{ url($photo) }}">Download</a></td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
        </div>

    </body>
</html>
