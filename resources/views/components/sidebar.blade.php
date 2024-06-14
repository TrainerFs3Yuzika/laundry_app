<nav class="side-nav">
    <a href="/" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset("dist/images/logo.svg")}}">
        <span class="hidden xl:block text-white text-lg ml-3">Laundry App</span>
    </a>
    <div class="side-nav__divider my-6"></div>
    <ul>
        @if(auth()->user()->role == 'admin')
        <li>
            <a href="{{ route('admin.dashboard') }}" class="side-menu {{ Route::is('admin.dashboard') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}" class="side-menu {{ Route::is('admin.users') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="users"></i></div>
                <div class="side-menu__title">Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('services.index') }}" class="side-menu {{ Route::is('services.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="package"></i></div>
                <div class="side-menu__title">Service</div>
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="side-menu {{ Route::is('categories.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="tag"></i></div>
                <div class="side-menu__title">Categories</div>
            </a>
        </li>
        <li>
            <a href="{{ route('transactions') }}" class="side-menu {{ Route::is('transactions') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="users"></i></div>
                <div class="side-menu__title">Transaction</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders') }}" class="side-menu {{ Route::is('admin.orders') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title">Orders</div>
            </a>
        @endif

        @if(auth()->user()->role == 'customer')
        <li>
            <a href="{{ route('customer.dashboard.index') }}" class="side-menu {{ Route::is('customer.dashboard.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title">Dashboard</div>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('transactions') }}" class="side-menu {{ Route::is('transactions') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="package"></i></div>
                <div class="side-menu__title">Transaction</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('customer.orders') }}" class="side-menu {{ Route::is('customer.orders') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title">Pesan Laundry</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.orders.history') }}" class="side-menu {{ Route::is('customer.orders.history') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title">Riwayat Pesanan</div>
            </a>
        </li>
        @endif
    </ul>
</nav>
