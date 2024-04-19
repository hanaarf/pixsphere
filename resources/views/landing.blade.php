<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pixsphere</title>
  <link rel="stylesheet" href="css/landing.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <nav>
    <img src="img/Group 31.svg" alt="" width="94px">
    <a href="{{ route('auth') }}">Sign In/Up</a>
  </nav>

  <div class="animasi">
    <div class="anmtxt">Discover</div>
    <div class="anmtxt">
      <span>a unique artwork</span>
    </div>
  </div>
  <p>Explore the best image decoration art</p>


  <section class="slider-container">
    <div class="slider-images">
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/5c/c6/80/5cc6805cb30b9a7d4cbb754ab40db80f.jpg" alt="1" />
        <h1>Art</h1>
        <div class="details">
          <h2>Art</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/8b/d9/b8/8bd9b886fa754b2b5a337569acab1e9e.jpg" alt="2" />
        <h1>Animal</h1>
        <div class="details">
          <h2>Animal</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/63/b6/4a/63b64afada5aa531ef746506a172d626.jpg" alt="3" />
        <h1>Jurnal</h1>
        <div class="details">
          <h2>Jurnal</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img active">
        <img src="https://i.pinimg.com/564x/84/86/93/848693b22cf1f442333e55c91d6683da.jpg" alt="4" />
        <h1>Abstrack</h1>
        <div class="details">
          <h2>Abstrack</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/1f/d9/cc/1fd9ccb5e0ea0b9c09bb0274bd384d4c.jpg" alt="5" />
        <h1>anime</h1>
        <div class="details">
          <h2>anime</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/1a/c3/0b/1ac30b9119ab9e900d8ac2c3d12b30ce.jpg" alt="6" />
        <h1>Nature</h1>
        <div class="details">
          <h2>Nature</h2>
          <p></p>
        </div>
      </div>
      <div class="slider-img">
        <img src="https://i.pinimg.com/564x/58/36/37/583637e798870c5a1acdfbf6f3735cfb.jpg" alt="7" />
        <h1>Potret</h1>
        <div class="details">
          <h2>Potret</h2>
          <p></p>
        </div>
      </div>
    </div>
  </section>

  <section class="explore-image">
    <h2>Explore<span> Image</span></h2>
    <p class="tekss">Find Inspiration, Treasure Memories, or Simply Enjoy Photography—Our Gallery is Your Haven.</p>
    <div data-aos="fade-up">
      <div class="image">
        <img src="img/ei-1.png" alt="">
        <img src="img/ei-2.png" alt="">
        <img src="img/ei-3.png" alt="">
      </div>
    </div>
  </section>

  <section class="start">
    <div data-aos="fade-down">
    <div class="wrap">
      <div class="today">
        <h2>Start Today</h2>
        <div class="hr"></div>
        <p>Start the Pixshpere App to help you on your way to a better picture wellbeing.</p>
        <button class="btn">learn more <span class="material-symbols-outlined">
            arrow_forward
          </span></button>
      </div>
      <div class="img">
        <img src="img/img-start.svg" alt="">
      </div>
    </div>
  </div>
  </section>

  <section class="features">
    <h2>Our interactive<span> Features</span></h2>
    <div data-aos="fade-up">
      <div class="image">
        <img src="img/Group 45.svg" alt="">
        <img src="img/Group 46.svg" alt="">
        <img src="img/Group 47.svg" alt="">
      </div>
    </div>
  </section>

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

  <script src="js/jQuery.js"></script>
  <script>
    jQuery(document).ready(function ($) {
      $(".slider-img").on("click", function () {
        $(".slider-img").removeClass("active");
        $(this).addClass("active");
      });
    });
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>