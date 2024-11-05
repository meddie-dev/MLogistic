<nav class="sb-topnav navbar navbar-expand @if (auth()->user()->role === 'supplier' || auth()->user()->role === 'constructor') navbar-light bg-light @else navbar-dark bg-dark @endif">

    <!-- Navbar Brand-->

    <a href="/" class="navbar-brand ps-3">
        <img src="/css/logo.png" alt="Logo" class="img-fluid" style="max-width: 150px;" style=`filter: {{ auth()->user()->role === 'supplier' ? 'brightness(1)' : 'brightness(0) invert(1)' }};`>
        <!-- MICROFINANCE -->
    </a>


    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>