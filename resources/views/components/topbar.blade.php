<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="{{ route('home') }}" class="">Home</a>
        @php
            $segments = Request::segments();
            $url = '';
            $prefix = auth()->user()->role == 'admin' ? '/dashboard' : '/customer/dashboard';
        @endphp
        @foreach ($segments as $index => $segment)
            @php
                // Adjust segment for customer role
                if ($index === 0 && auth()->user()->role == 'customer') {
                    $segment = 'customer';
                }

                // Build URL
                $url .= '/' . $segment;

                // Format title
                $title = ucfirst(str_replace('-', ' ', $segment));

                // Check if it's the last segment
                $isLastSegment = $index === count($segments) - 1;
            @endphp
            <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            @if ($isLastSegment)
                <span class="breadcrumb--active">{{ $title }}</span>
            @else
                <a href="{{ url($url) }}">{{ $title }}</a>
            @endif
        @endforeach
    </div>




    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <a href="/" >
        <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> Back to Home </button>
    </a>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    {{-- <div class="intro-x dropdown relative mr-auto sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer"> <i data-feather="bell" class="notification__icon"></i> </div>
        <div class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
            <div class="notification-content__box dropdown-box__content box">
                <div class="notification-content__title">Notifications</div>
                <div class="cursor-pointer relative flex items-center ">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("dist/images/profile-13.jpg    ")}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Angelina Jolie</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("dist/images/profile-2.jpg")}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Johnny Depp</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("dist/images/profile-14.jpg")}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("dist/images/profile-6.jpg")}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Al Pacino</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset("dist/images/profile-5.jpg")}}">
                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Edward Norton</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8 relative">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="Midone Tailwind HTML Admin Template" src="{{asset("dist/images/profile-12.jpg")}}">
        </div>
        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
            <div class="dropdown-box__content box bg-theme-38 text-white">
                <div class="p-4 border-b border-theme-40">
                    <div class="font-medium">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-theme-41">{{ Auth::user()->role }}</div>
                </div>
                <div class="p-2">
                    <a href="{{route('profile.index')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                    @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.users') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                        <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account
                    </a>
                @endif
                </div>
                <div class="p-2 border-t border-theme-40">
                    <a href="{{route('logout')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
