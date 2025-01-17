<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="{{ request()->routeIs('home') ? 'bi bi-house-fill' : 'bi bi-house' }}"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    @auth
        @if (auth()->user()->role == 'Admin')
        <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="{{ request()->routeIs('user.index') ? 'bi bi-menu-button-wide-fill' : 'bi bi-menu-button-wide' }}"></i>
                <span>User</span>
            </a>
        </li>
        @endif
    @endauth

    <li class="nav-item {{ request()->routeIs('skck.index') || request()->routeIs('skck.create') || request()->routeIs('skck.edit') ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('skck.index') }}">
            <i class=" {{ request()->routeIs('skck.index') || request()->routeIs('skck.create') || request()->routeIs('skck.edit') ? 'bi bi-archive-fill' : 'bi bi-archive' }}"></i>
            <span>SKCK</span>
        </a>
    </li><!-- End SKCK Nav -->

    <li
        class="nav-item {{ request()->routeIs('skck.input') || request()->routeIs('skck.output') || request()->routeIs('skck.broken') ? 'active' : '' }}">
        <a class="nav-link collapsed" data-bs-target="#data-skck" data-bs-toggle="collapse" href="#">
            <i
                class="{{ request()->routeIs('skck.input') || request()->routeIs('skck.output') || request()->routeIs('skck.broken') ? 'bi bi-file-text-fill' : 'bi bi-file-text' }}"></i>
            <span>Data SKCK</span>
            <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="data-skck"
            class="nav-content collapse {{ request()->routeIs('skck.input') || request()->routeIs('skck.output') || request()->routeIs('skck.broken') ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">
            <li class="{{ request()->routeIs('skckdetail.input') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('skckdetail.input') }}">
                    <i class="bi bi-grid"></i>
                    <span>Data Input</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('skckdetail.output') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('skckdetail.output') }}">
                    <i class="bi bi-grid"></i>
                    <span>Data Output</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('skckdetail.broken') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('skckdetail.broken') }}">
                    <i class="bi bi-grid"></i>
                    <span>Data Rusak</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item {{ request()->routeIs('skck.report') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('skck.report') }}">
            <i class="{{ request()->routeIs('skck.report') ? 'bi bi-square-fill' : 'bi bi-square' }}"></i>
            <span>Report</span>
        </a>
    </li>

</ul>
