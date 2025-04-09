<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'dashboardGuru' ? '' : 'collapsed' }}" href="{{ route('dashboard.guru') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'absen' ? '' : 'collapsed' }}" href="{{ route('absen.index') }}">
                <i class="bi bi-grid"></i>
                <span>Absen</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->