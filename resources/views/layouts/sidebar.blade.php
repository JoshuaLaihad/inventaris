<ul class="sidebar-nav" id="sidebar-nav">

    @auth
        @if (auth()->user()->role == 'ba_intelkam')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif
    @endauth

    <li class="nav-item">
        <a class="nav-link " href="{{ route('status.index') }}">
            <i class="bi bi-grid"></i>
            <span>Status</span>
        </a>
    </li><!-- End Status Nav -->

    <li class="nav-item">
        <a class="nav-link " href="{{ route('kesatuan.index') }}">
            <i class="bi bi-grid"></i>
            <span>Kesatuan</span>
        </a>
    </li><!-- End Kesatuan Nav -->

    <li class="nav-item">
        <a class="nav-link " href="{{ route('skck.index') }}">
            <i class="bi bi-grid"></i>
            <span>SKCK</span>
        </a>
    </li><!-- End SKCK Nav -->

    <li class="nav-heading">Pages</li>

</ul>
