<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset("dist/images/logo.svg")}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>

    <ul class="border-t border-theme-24 py-5 hidden">
        @if(auth()->user()->role == 'admin')
        <li>
            <a href="{{ route('admin.dashboard') }}" class="menu {{ Route::is('admin.dashboard') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="home"></i></div>
                <div class="menu__title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users') }}" class="menu {{ Route::is('admin.users') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="users"></i></div>
                <div class="menu__title">Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('services.index') }}" class="menu {{ Route::is('services.index') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="package"></i></div>
                <div class="menu__title">Service</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders') }}" class="menu {{ Route::is('admin.orders') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="menu__title">Orders</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.ratings') }}" class="menu {{ Route::is('admin.ratings') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="star"></i></div>
                <div class="menu__title">Ratings & Reviews</div>
            </a>
        </li>


        {{-- setting --}}
        <li>
            <a href="{{ route('admin.settings') }}" class="menu {{ Route::is('admin.settings') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="settings"></i></div>
                <div class="menu__title">Settings</div>
            </a>
        </li>
        @endif

        @if(auth()->user()->role == 'customer')
        <li>
            <a href="{{ route('customer.dashboard.index') }}" class="menu {{ Route::is('customer.dashboard.index') || Route::is('customer.trackOrder') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="home"></i></div>
                <div class="menu__title">Dashboard</div>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('transactions') }}" class="menu {{ Route::is('transactions') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="package"></i></div>
                <div class="menu__title">Transaction</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('customer.orders') }}" class="menu {{ Route::is('customer.orders') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="menu__title">Pesan Laundry</div>
            </a>
        </li>
        <li>
            <a href="{{ route('customer.orders.history') }}" class="menu {{ Route::is('customer.orders.history') || Route::is('customer.orders.invoice') || Route::is('customer.payment') ? 'menu--active' : '' }}">
                <div class="menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="menu__title">Riwayat Pesanan</div>
            </a>
        </li>
        @endif
    </ul>
</div>
