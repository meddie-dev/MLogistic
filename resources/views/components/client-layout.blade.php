<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Logistics II</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Favicons -->
  <link href="/css/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/vendorSide/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendorSide/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendorSide/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/vendorSide/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/vendorSide/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/vendorSide/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <!-- Client Logo -->
      <!-- <div class="col d-flex align-items-center">
        <a href="/" class="logo me-auto">
          <img src="/css/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
        </a>
      </div> -->

      <div class="col d-flex align-content-center ">
        <a href="/" class="mt-2">
          <h3>Logistics II</h3>
        </a>
      </div>


      <nav id="navmenu" class="navmenu" style="display: none;">
        <ul>
          <li><a href="#hero" id="home" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    
      @Guest
        <a class="btn-getstarted" href="/login">Get Started</a>
      @endGuest

      @auth
      @if(Auth::user()->role == 'admin')
        <a class="btn-getstarted" href="/admin/dashboard">Dashboard</a>
    @elseif(Auth::user()->role == 'supplier')
        <a class="btn-getstarted" href="/supplier/dashboard">Dashboard</a>
    @elseif(Auth::user()->role == 'constructor')
        <a class="btn-getstarted" href="/constructor/dashboard">Dashboard</a>
    @endif
      @endauth
    </div>
  </header>

  <main class="main">

    {{ $slot }}

  </main>

  <footer id="footer" class="footer light-background" style="display: none;">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <div class="col d-flex align-items-center">
            <a href="/" class="clients">
              <img src="/css/logo_footer.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </a>
          </div>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Audit services</a></li>
            <li><a href="#">Fleet services</a></li>
            <li><a href="#">Vehicle Resevation</a></li>
            <li><a href="#">Vendor services</a></li>
            <li><a href="#">Document services</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>10C DS Global Corporate Center, Mindanao Ave. Extension, Greater Lagro, Quezon City, Metro Manila, NCR Philippines 1100</p>
          <p class="mt-4"><strong>Phone:</strong> <span>(+63) 908 888 5626</span></p>
          <p><strong>Email:</strong> <span>hello@dsfinance.ph</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">DS Global Holdings Inc.</strong> <span>All Rights Reserved</span></p>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="/vendorSide/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendorSide/assets/vendor/php-email-form/validate.js"></script>
  <script src="/vendorSide/assets/vendor/aos/aos.js"></script>
  <script src="/vendorSide/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="/vendorSide/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/vendorSide/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/vendorSide/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="/vendorSide/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="/vendorSide/assets/js/main.js"></script>

  <script>
    // Get the current page path
    const currentPath = window.location.pathname;

    // Get the navmenu element
    const navMenu = document.getElementById('navmenu');
    const footer = document.getElementById('footer');

    // Check if the current page is the landing page
    if (currentPath === '/landing') {
      // Hide the navmenu by setting display to none
      navMenu.style.display = 'block';

      // Hide the footer by setting display to none
      footer.style.display = 'block';
    }

  </script>


</body>

</html>