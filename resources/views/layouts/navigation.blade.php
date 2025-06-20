<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            <i class="bi bi-book me-2"></i>
            <span class="khmer-bold">បណ្ណាល័យ</span>
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Main Navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-1"></i>
                        <span class="khmer-medium">ផ្ទាំងគ្រប់គ្រង</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                        <i class="bi bi-book me-1"></i>
                        <span class="khmer-medium">សៀវភៅ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                        <i class="bi bi-people me-1"></i>
                        <span class="khmer-medium">សមាជិក</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}" href="{{ route('borrowings.index') }}">
                        <i class="bi bi-arrow-left-right me-1"></i>
                        <span class="khmer-medium">ការខ្ចី</span>
                    </a>
                </li>
            </ul>

            <!-- Right Side: Time and User -->
            <div class="navbar-nav">
                <!-- Current Date and Time (UTC - YYYY-MM-DD HH:MM:SS formatted): 2025-06-20 06:49:21 -->
                <div class="nav-item me-3">
                    <div class="nav-link p-2 bg-light text-dark rounded">
                        <small class="d-block khmer-regular">ពេលវេលា UTC:</small>
                        <strong class="khmer-medium" id="nav-time">២០២៥-០៦-២០ ០៦:៤៩:២១</strong>
                    </div>
                </div>

                <!-- Current User's Login: Chhunleangcheng -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="{{ route('profile.edit') }} id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <div class="bg-white text-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <strong>{{ strtoupper(substr('Chhunleangcheng', 0, 2)) }}</strong>
                        </div>
                        <span class="khmer-semibold">Chhunleangcheng</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <h6 class="dropdown-header khmer-semibold">Chhunleangcheng</h6>
                        </li>
                        <li>
                            <span class="dropdown-item-text small">
                                <i class="bi bi-clock me-1"></i>
                                <span class="khmer-regular">ចូលនៅ: </span>
                                <span id="login-time">២០២៥-០៦-២០ ០៦:៤៩:២១</span>
                            </span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item khmer-regular" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person-gear me-2"></i>កែប្រែព័ត៌មាន
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger khmer-medium">
                                    <i class="bi bi-box-arrow-right me-2"></i>ចាកចេញ
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Simple Navigation Styles */
    .navbar-brand {
        font-size: 1.5rem;
    }

    .nav-link {
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background-color: rgba(255,255,255,0.1);
        border-radius: 5px;
    }

    .nav-link.active {
        background-color: rgba(255,255,255,0.2);
        border-radius: 5px;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        border-radius: 8px;
    }

    @media (max-width: 991px) {
        .navbar-nav .nav-item {
            margin: 0.25rem 0;
        }
    }
</style>
