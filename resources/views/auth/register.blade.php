<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Register - Midone - Tailwind HTML Admin Template</title>
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const strengthMeter = document.getElementById('password-strength-meter');
            const strengthText = document.getElementById('password-strength-text');
            const strengthBars = Array.from(strengthMeter.children);

            passwordInput.addEventListener('input', function () {
                const strength = getPasswordStrength(passwordInput.value);
                updateStrengthMeter(strength);
                updateStrengthText(strength);
            });

            function getPasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength += 1;
                if (password.match(/[a-z]/)) strength += 1;
                if (password.match(/[A-Z]/)) strength += 1;
                if (password.match(/[0-9]/)) strength += 1;
                if (password.match(/[\W_]/)) strength += 1;
                return strength;
            }

            function updateStrengthMeter(strength) {
                const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500', 'bg-blue-500'];
                strengthBars.forEach((bar, index) => {
                    bar.className = `col-span-3 h-full rounded ${index < strength ? colors[strength - 1] : 'bg-gray-200'}`;
                });
            }
            function updateStrengthText(strength) {
        const strengthDescriptions = ['Very Weak', 'Weak',  'Strong', 'Very Strong'];
        strengthText.textContent = strengthDescriptions[strength - 1] || '';
    }
        });
    </script>
</head>
<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">

                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/3 -mt-16" src="{{ asset('frontend/img/laundry.webp') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        BrightWash
                        <br>
                        sign up to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
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
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" name="name" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Username">
                            <input type="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Email">
                            <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
                            <div id="password-strength-meter" class="intro-x w-full grid grid-cols-12 gap-4 h-1 mt-3">
                                <div class="col-span-3 h-full rounded bg-gray-200"></div>
                                <div class="col-span-3 h-full rounded bg-gray-200"></div>
                                <div class="col-span-3 h-full rounded bg-gray-200"></div>
                                <div class="col-span-3 h-full rounded bg-gray-200"></div>
                            </div>
                            <p id="password-strength-text" class="intro-x mt-2"></p>

                            <input type="password" name="password_confirmation" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password Confirmation">
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Register</button>
                            <a href="{{ route('login') }}">
                                <button type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Sign In</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/app.js') }}"></script>
</body>
</html>
