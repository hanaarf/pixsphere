<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $album->id }}</title>

  
</head>
<body class="font-Mplus1">
  <div class="w-full h-screen flex flex-col items-center py-16">

    <div class="flex flex-col gap-3 px-8 w-full mt-28">
      @php
        $totalPhoto = count($photos);
      @endphp
      <p class="font-semibold text-lg">{{ $totalPhoto }} Photos</p>

      <div class="grid grid-cols-5 w-full h-full gap-1">
        {{-- <div class="grid gap-4"> --}}
          @foreach($photos as $photo)
            @php 
              $url = Storage::url('images/'.$photo->photo); 
              $user = $photo->user;
            @endphp


            <div class="flex flex-col gap-2 px-2">
              <img src="{{ url($url) }}" class="bg-cover w-full rounded-lg h-auto max-h-64 relative hover:brightness-[.65] cursor-pointer transition-all duration-200" />

              @if($photo->title)
                <p class="text-sm text-card font-semibold -my-[2px]">{{$photo->title}}</p>
              @endif

              <div class="flex flex-row items-center gap-2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png" alt="" class="w-7 h-7 rounded-full bg-cover border-[0.5px] border-gray-300">
        
              </div>
            </div>
          @endforeach
        {{-- </div> --}}
      </div>
    </div>
  </div>
</body>
</html>