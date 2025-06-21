<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">Absen Siswa</span>
        </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <!-- Notification Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    @if(Auth::user()->guru)
                    <span class="badge bg-primary badge-number">{{ Auth::user()->guru->notifications->where('is_read', false)->count() }}</span>
                    @else
                    <span class="badge bg-primary badge-number">0</span>
                    @endif
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" data-bs-auto-close="outside">
                    <li class="dropdown-header">
                        @if(Auth::user()->guru)
                        You have {{ Auth::user()->guru->notifications->where('is_read', false)->count() }} new notifications
                        @else
                        You have 0 new notifications
                        @endif
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @if(Auth::user()->guru)
                    @foreach(Auth::user()->guru->notifications->where('is_read', false) as $notification)
                    <li class="notification-item p-0">
                        <a href="{{ route('pengajuan.index3') }}" style="display:block; text-decoration:none; color:inherit; padding:10px 16px;">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>{{ $notification->title }}</h4>
                                <p>{{ $notification->message }}</p>
                                <p>{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @endforeach
                    @endif

                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <!-- Profile Dropdown -->
            @if(Auth::check())
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/profil.jpg') }}" class="rounded-circle" alt="Profile">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                </a><!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->username }}</h6>
                        <span>{{ Auth::user()->level }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li>
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </li>
                    </form>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
            @endif

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->