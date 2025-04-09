<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ $menu == 'home' ? '' : 'collapsed' }}" href="{{ route('dashboard.admin') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'siswa' ? '' : 'collapsed' }}" href="{{ route('siswa.index') }}">
                <i class="bi bi-person"></i>
                <span>Data Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'guru' ? '' : 'collapsed' }}" href="{{ route('guru.index') }}">
                <i class="bi bi-person-workspace"></i>
                <span>Data Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'lokal' || $menu == 'jurusan' ? '' : 'collapsed' }}" href="{{ route('lokal.index') }}">
                <i class="bi bi-building"></i>
                <span>Data Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'walikelas' ? '' : 'collapsed' }}" href="{{ route('walikelas.index') }}">
                <i class="ri-nurse-fill"></i>
                <span>Data Wali Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $menu == 'ortu' ? '' : 'collapsed' }}" href="{{ route('ortu.index') }}">
                <i class="bi bi-people"></i>
                <span>Data Orang Tua</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ $menu == 'register' ? '' : 'collapsed' }}" href="{{ route('register') }}">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>
    </ul>

</aside><!-- End Sidebar-->