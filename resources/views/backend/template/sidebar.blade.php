<ul class="nav flex-column pt-3 pt-md-0">
    <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
                <img src="{{ asset('backend') }}/assets/img/brand/light.svg" height="20"
                    width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">Yummy Panel</span>
        </a>
    </li>
    <li class="nav-item  active ">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                </svg>
            </span>
            <span class="sidebar-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#master">
            <span>
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="sidebar-text">Master</span>
            </span>
            <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </span>
        <div class="multi-level collapse " role="list" id="master" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ asset('backend') }}/pages/tables/bootstrap-tables.html">
                        <span class="sidebar-text">Menu</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="multi-level collapse " role="list" id="master" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ asset('backend') }}/pages/tables/bootstrap-tables.html">
                        <span class="sidebar-text">Chef</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="multi-level collapse " role="list" id="master" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ asset('backend') }}/pages/tables/bootstrap-tables.html">
                        <span class="sidebar-text">Events</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <span class="nav-link  collapsed  d-flex justify-content-between align-items-center"
            data-bs-toggle="collapse" data-bs-target="#gallery">
            <span>
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="sidebar-text">Gallery</span>
            </span>
            <span class="link-arrow">
                <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </span>
        <div class="multi-level collapse " role="list" id="gallery" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('panel.image.index') }}">
                        <span class="sidebar-text">Foto</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="multi-level collapse " role="list" id="gallery" aria-expanded="false">
            <ul class="flex-column nav">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ asset('backend') }}/pages/tables/bootstrap-tables.html">
                        <span class="sidebar-text">Video</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item ">
        <a href="{{ asset('backend') }}/pages/transactions.html" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd"
                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <span class="sidebar-text">Transactions</span>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ asset('backend') }}/pages/transactions.html" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd"
                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <span class="sidebar-text">Reviews</span>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ asset('backend') }}/pages/settings.html" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <span class="sidebar-text">Settings</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"
            class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
            <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
    </li>
</ul>