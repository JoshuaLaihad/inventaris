<div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/skck1.png') }}" alt="">
        <span class="d-none d-lg-block">Inventaris SKCK</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <!-- Elemen tambahan lainnya (jika ada) -->

        <!-- Dropdown atau Profil -->
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2">Log Out</span>
            </a>
            <!-- Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav><!-- End Icons Navigation -->
