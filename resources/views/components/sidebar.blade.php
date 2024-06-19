<nav class="side-nav">
    <a href="/" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset("dist/images/logo.svg")}}">
        <span class="hidden xl:block text-white text-lg ml-3">{{ $setting->website_title }}</span>
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
            <a href="{{ route('admin.orders') }}" class="side-menu {{ Route::is('admin.orders') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title">Orders</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.ratings') }}" class="side-menu {{ Route::is('admin.ratings') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="star"></i></div>
                <div class="side-menu__title">Ratings & Reviews</div>
            </a>
        </li>

        {{-- discount --}}
        <li>
            <a href="{{ route('discounts.index') }}" class="side-menu {{ Route::is('discounts.index') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="percent"></i></div>
                <div class="side-menu__title">Discounts</div>
            </a>
        </li>
        {{-- setting --}}
        <li>
            <a href="{{ route('admin.settings') }}" class="side-menu {{ Route::is('admin.settings') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="settings"></i></div>
                <div class="side-menu__title">Settings</div>
            </a>
        </li>
        @endif

        @if(auth()->user()->role == 'customer')
        <li>
            <a href="{{ route('customer.dashboard.index') }}" class="side-menu {{ Route::is('customer.dashboard.index') || Route::is('customer.trackOrder') ? 'side-menu--active' : '' }}">
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
                <div class="side-menu__title">Order Laundry</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.orders.history') }}" class="side-menu {{ Route::is('customer.orders.history') || Route::is('customer.orders.invoice') || Route::is('customer.payment') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title">Order History</div>
            </a>
        </li>
        @endif
    </ul>
</nav>
