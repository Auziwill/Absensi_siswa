<aside id="sidebar" class="sidebar">
<ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'dashboardAdmin' ? '' : 'collapsed' }}" href="{{ route('dashboard.admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'guru' ? '' : 'collapsed' }}" href="{{ route('guru.index') }}">
                <i class="bi bi-person-workspace"></i>
                <span>Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'siswa' ? '' : 'collapsed' }}" href="{{ route('siswa.index') }}">
                <i class="bi bi-person"></i>
                <span>Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'ortu' ? '' : 'collapsed' }}" href="{{ route('ortu.index') }}">
                <i class="bi bi-person-lines-fill"></i>
                <span>Orang Tua</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'walikelas' ? '' : 'collapsed' }}" href="{{ route('walikelas.index') }}">
                <i class="ri-nurse-fill"></i>
                <span>Wali Kelas</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'lokal' || $menu == 'jurusan' ? '' : 'collapsed' }}" href="{{ route('lokal.index') }}">
                <i class="bi bi-building"></i>
                <span>lokal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'user' ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>User</span>
            </a>
        </li>
        
        
    </ul>

</aside><!-- End Sidebar-->