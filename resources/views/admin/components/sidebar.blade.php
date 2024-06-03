<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="dist/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> Laundry App</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route("admin.dashboard") }}" class="side-menu side-menu--{{ Route::is("admin.dashboard") ? "active" : ""}}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{route("admin.users")}}" class="side-menu side-menu--{{ Route::is("admin.users") ? "active" : ""}}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Users </div>
            </a>
        </li>
        <li>
            <a href="{{route("products.index")}}" class="side-menu side-menu--{{ Route::is("products.index") ? "active" : ""}}">
                <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                <div class="side-menu__title"> Products </div>
            </a>
        </li>
        <li>
            <a href="{{route("categories.index")}}" class="side-menu side-menu--{{ Route::is("categories.index") ? "active" : ""}}">
                <div class="side-menu__icon"> <i data-feather="tag"></i> </div>
                <div class="side-menu__title"> Categories </div>
            </a>
        </li>
        <li>
            <a href="{{route("transactions")}}" class="side-menu side-menu--{{ Route::is("transactions") ? "active" : ""}}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Transaction </div>
            </a>
        </li>
    </ul>
</nav>
