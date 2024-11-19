<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Title -->
  <title>Logistics II</title>

  <!-- Favicon -->
  <link href="/css/favicon.ico" rel="icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Template Plugins -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

  <!-- Vite Plugins and Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin="" />

</head>

<body class="tw-bg-gray-100 tw-p-8 ">

  <div class="sb-nav-fixed">
    @include('components.partials.navbar')

    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        @include('components.partials.sidebar')
      </div>

      <div id="layoutSidenav_content">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-custom-position" role="alert" id="autoHideAlert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="container-fluid px-4">
          <!-- Page Content goes here -->
          {{ $slot }}
        </main>

        @include('components.partials.footer')
      </div>

      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top tw-flex tw-items-center tw-justify-center
            @if (auth()->user()->role === 'supplier' || auth()->user()->role === 'distributor' || auth()->user()->role === 'customer')
                tw-bg-indigo-600
            @endif
            "><i class="fas fa-arrow-up tw-text-white"></i></a>

      <!-- Preloader -->
      <div id="preloader"></div>

    </div>
  </div>

  <!-- Template Scripts Plugins   -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>

</body>

</html>