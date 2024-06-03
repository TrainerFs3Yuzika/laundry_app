<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Login - Laundry App</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->


<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <div class="my-auto">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mb-20"style="display: flex; justify-content: center;">
                       <img src={{asset("frontend\img\laundry.webp")}} alt="" width="280">

                    </div>

                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->

            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">


                @if (session('error'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
                    <strong>Gagal! </strong> {{ session('error') }}
                </div>
                @endif


                @if ($errors->any())
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6">
                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>
                    <strong>Gagal! </strong> {{ $errors->first() }}
                </div>
                @endif

                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign In
                    </h2>
                    <form action="{{ route('login.post') }}" method="POST" class="form-signin">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" name="email" value="{{ old('email') }}"
                                class="intro-x login__input input input--lg border border-gray-300 block"
                                placeholder="Email">

                            <input type="password" name="password" value="{{ old('password') }}"
                                class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                                placeholder="Password">

                        </div>
                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" name="remember" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="">Forgot Password?</a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit"
                                class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                            {{-- <button class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign up</button> --}}
                        </div>
                    </form>
                </div>
            </div>

            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script>
        // toast when success or error message
        @if (session('success'))
                   $.toast({
                    text: "{{ session('success') }}" ,
                    bgColor: '#41B06E',
                    textColor: 'white',
                    allowToastClose: true,
                    hideAfter: 5000,
                    stack: 5,
                    textAlign: 'left',
                    position: 'top-right',
                });
                @endif
    </script>
    <!-- END: JS Assets-->
</body>

</html>
