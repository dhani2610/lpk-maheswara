<nav class="navbar navbar-expand bg-white d-flex justify-content-between align-items-center">
    <button class="btn-toggle" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>

    <div class="navbar-nav align-items-center">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=c62828&color=fff"
                    class="avatar rounded-circle me-2" alt="Profile">
                <span class="d-none d-md-block fw-bold text-dark">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
                <li>
                    <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-bold border-0 bg-transparent" style="cursor: pointer;">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
