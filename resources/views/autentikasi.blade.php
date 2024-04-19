<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Autentikasi Pixsphere</title>
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
@if($message = Session::get('success'))
<div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Success!</strong> {{ $message }}
</div>
@endif

@if ($errors->any())
    <div class="alert danger">
      <span class="closebtn">&times;</span>  
      <strong></strong>  @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
    </div>
@endif
  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap">
          <form action="{{ route('login') }}" method="POST" autocomplete="off" class="sign-in-form">
            @csrf 
            <div class="logo">
                <img src="./img/logo_pixsphere.png" alt="pixsphere" />
            </div>
            <div class="heading">
                <h2>Sign In Here !</h2>
                <h6> Enter your login details to proceed on your journey.</h6>
            </div>

            <div class="actual-form">
                <div class="input-wrap">
                    <input type="text" minlength="4" class="input-field" name="username" autocomplete="off" required />
                    <label>Username</label>
                </div>

                <div class="input-wrap">
                    <input type="password" minlength="4" class="input-field" name="password" autocomplete="off" required />
                    <label>Password</label>
                </div>

                <div class="kotak" style="margin-top: -10px;color:#bbb;font-size:12px;display: flex;gap: 3px;">
                    <input type="checkbox" id="passwordVisibilityCheckbox">
                    <span class="material-symbols-outlined"
                          style="color:#bbb;font-size: 1.2rem; text-align: center;">visibility_off</span>
                </div>

                <div class="button" style="display: flex;gap: 5px;">
                    <input type="submit" value="Sign In" class="sign-btn" />
                    <!-- <div class="sign-btn1">
                        <img src="img/image 6.png" alt="" width="20px">Google
                    </div> -->
                </div>

                <div class="heading">
                    <h6>Not registered yet?
                        <a href="#" class="toggle">Sign Up</a></h6>
                </div>
            </div>
          </form>


          <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="sign-up-form">
            @csrf 
            <div class="logo">
                <img src="./img/logo_pixsphere.png" alt="pixsphere" />
            </div>

            <div class="heading">
                <h2 style="font-size: 25px;">Sign Up Here !</h2>
                <h6>Let's begin your journey by creating your account</h6>
            </div>

              <div class="actual-form">
                  <div class="upload">
                      <img id="uploaded-image" src="https://lh3.googleusercontent.com/proxy/1h3Tvn0synhmImO4ckfNg569YQPG-68BmVGKxno7Dyy2Bv-q-nSy17NGRcYcuKjjWnpF0hn2sqDP8zYZWIiWor1PnoCHzvXmXbN6FvC76fx4c5sSTdve-VVuhnbU4PlvBlH3MoUW2Ck6aL1hRgYAgy08ExafSWJVK0WdH7X9w4gW=w1200-h630-p-k-no-nu" alt="">
                      <div class="round">
                          <input type="file" id="file-input" name="photo_profil">
                          <i class="fa fa-camera" style="color: #fff;font-size: 11px;"></i>
                      </div>
                  </div>

                  <input type="text" value="user" name="role" hidden/>

                  <div class="input-wrap">
                      <input type="text" minlength="4" class="input-field" name="name" autocomplete="off" required />
                      <label>name</label>
                  </div>

                  <div class="input-wrap">
                      <input type="text" minlength="4" class="input-field" name="username" autocomplete="off" required />
                      <label>Username</label>
                  </div>

                  <div class="input-wrap">
                      <input type="email" class="input-field" autocomplete="off" name="email" required />
                      <label>Email</label>
                  </div>

                  <div class="input-wrap">
                      <input type="password" minlength="4" class="input-field" name="password" autocomplete="off" required />
                      <label>Password</label>
                  </div>

                  <div class="kotak" style="margin-top: -10px;color:#bbb;font-size:12px;display: flex;gap: 3px;">
                    <input type="checkbox" id="passwordVisibilityCheckbox1">
                    <span class="material-symbols-outlined"
                      style="color:#bbb;font-size: 1.2rem; text-align: center;">visibility_off</span>
                  </div>

                  <div class="button" style="display: flex;gap: 5px;">
                      <input type="submit" value="Sign Up" class="sign-btn" />
                      <!-- <div class="sign-btn1">
                          <img src="img/image 6.png" alt="" width="20px">Google
                      </div> -->
                  </div>

                  <div class="heading">
                      <h6>Already have an account?
                          <a href="#" class="toggle">Sign In</a></h6>
                  </div>
              </div>
          </form>


        </div>

        <div class="carousel">
          <div class="images-wrapper">
            <img src="img/A4 - 3.png" class="image img-1 show" alt="" />
            <img src="img/A4 - 2 (1).png" class="image img-2" alt="" />
            <img src="img/A4 - 1 (3).png" class="image img-3" alt="" />
          </div>

          <div class="text-slider1">
            <div class="text-wrap1">
              <div class="text-group1">
                <h2>Great to See You Here</h2>
                <h2>Customize as you like</h2>
                <h2>Let's get started</h2>
              </div>
            </div>
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h2>Welcome! Ready to continue your journey?</h2>
                <h2>Please enter your credentials to access your account</h2>
                <h2> Let's start exploring photos!</h2>
              </div>
            </div>
            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

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
    const checkbox = document.getElementById('passwordVisibilityCheckbox');
    const icon = document.querySelector('.kotak .material-symbols-outlined');
    const passwordInput = document.querySelector('.input-wrap input[type="password"]');
    checkbox.addEventListener('click', function () {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.textContent = "visibility";
      } else {
        passwordInput.type = "password";
        icon.textContent = "visibility_off";
      }
    });
  </script>

  <script>
    const checkbox1 = document.getElementById('passwordVisibilityCheckbox1');
    const icon1 = document.querySelector('.kotak .material-symbols-outlined');
    const passwordInputt = document.querySelector('.sign-up-form .input-wrap input[type="password"]');
    checkbox1.addEventListener('click', function () {
      if (passwordInputt.type === "password") {
        passwordInputt.type = "text";
        icon1.textContent = "visibility";
      } else {
        passwordInputt.type = "password";
        icon1.textContent = "visibility_off";
      }
    });
  </script>

  <script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
      }
    }
  </script>
  <script src="js/app.js"></script>
</body>

</html>