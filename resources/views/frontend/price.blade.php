<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
        <title>{{ $title }} - BrightWash Laundry</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free Website Template" name="keywords">
        <meta content="Free Website Template" name="description">

        <!-- Favicon -->
        <link href="{{ asset('img/favicon.ico') }}" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('lib/flaticon/font/flaticon.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    </head>

    <body>
        <!-- Top Bar Start -->
        <div class="top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <h1>BW<span>Laundry</span></h1>
                                <!-- <img src="img/logo.jpg" alt="Logo"> -->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 d-none d-lg-block">
                        <div class="row">
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Opening Hour</h3>
                                        <p>Mon - Fri, 8:00 - 19:00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="fa fa-phone-alt"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Call Us</h3>
                                        <p>+628 5728 9964 99</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="top-bar-item">
                                    <div class="top-bar-icon">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="top-bar-text">
                                        <h3>Email Us</h3>
                                        <p>brightwash@laundry.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="nav-bar">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                        <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                            <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                            <a href="{{ route('service') }}" class="nav-item nav-link">Service</a>
                            <a href="#" class="nav-item nav-link active">Price</a>
                            <a href="{{ route('location') }}" class="nav-item nav-link">Laundry Points</a>
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('blog') }}" class="dropdown-item">Blog Grid</a>
                                    <a href="{{ route('single') }}" class="dropdown-item">Detail Page</a>
                                    <a href="{{ route('team') }}" class="dropdown-item">Team Member</a>
                                    <a href="{{ route('booking') }}" class="dropdown-item">Schedule Booking</a>
                                </div>
                            </div>
                            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a> -->
                        </div>
                        @guest
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="{{route('login')}}">Login</a>
                        </div>

                        @else
                        <div class="ml-auto">
                            @if(Auth::user()->role == 'admin')
                                <a class="btn btn-custom" href="{{route('admin.dashboard')}}">Dashboard</a>
                            @elseif(Auth::user()->role == 'user')
                                <a class="btn btn-custom" href="{{route('customer.dashboard.index')}}">Dashboard</a>
                            @endif
                        </div>

                        @endguest
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->
        
        
        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Washing Price</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Price</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Price Start -->
        <div class="price">
            <div class="container">
                <div class="section-header text-center">
                    <p>Washing Price</p>
                    <h2>Choose Your Wash Price</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>Basic Cleaning</h3>
                                <h2><span>Rp.</span><strong>15</strong><span>.000</span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Standard Washing</li>
                                    <li><i class="far fa-check-circle"></i>Drying</li>
                                    <li><i class="far fa-check-circle"></i>Folding</li>
                                    <li><i class="far fa-times-circle"></i>Deep Cleaning</li>
                                    <li><i class="far fa-times-circle"></i>Controlled Drying</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                            <a class="btn btn-custom" href="{{ route('customer.orders') }}">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item featured-item">
                            <div class="price-header">
                                <h3>Premium Cleaning</h3>
                                <h2><span>Rp.</span><strong>30</strong><span>.000</span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Deep Cleaning</li>
                                    <li><i class="far fa-check-circle"></i>Controlled Drying</li>
                                    <li><i class="far fa-check-circle"></i>Quality Inspection</li>
                                    <li><i class="far fa-check-circle"></i>Aromatherapy Finish</li>
                                    <li><i class="far fa-times-circle"></i>Special Treatment</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                            <a class="btn btn-custom" href="{{ route('customer.orders') }}">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="price-item">
                            <div class="price-header">
                                <h3>Complex Cleaning</h3>
                                <h2><span>Rp.</span><strong>40</strong><span>.000</span></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <li><i class="far fa-check-circle"></i>Advanced Washing Techniques</li>
                                    <li><i class="far fa-check-circle"></i>Gentle Drying Process</li>
                                    <li><i class="far fa-check-circle"></i>Detailed Hand Finishing</li>
                                    <li><i class="far fa-check-circle"></i>Thorough Quality Check</li>
                                    <li><i class="far fa-check-circle"></i>Special Treatment</li>
                                </ul>
                            </div>
                            <div class="price-footer">
                            <a class="btn btn-custom" href="{{ route('customer.orders') }}">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Price End -->
        
        
        <!-- Footer Start -->
        <div class="footer">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mx-auto">
                <div class="footer-contact">
                    <h2>Get In Touch</h2>
                    <p><i class="fa fa-map-marker-alt"></i>123 Street, Semarang, Indonesia</p>
                    <p><i class="fa fa-phone-alt"></i>+628 5728 9964 99</p>
                    <p><i class="fa fa-envelope"></i>brightwas@laundry.com</p>
                    <!-- <div class="footer-social">
                        <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mx-auto">
                <div class="footer-link">
                    <h2>Popular Links</h2>
                    <a href="{{ route('about') }}">About Us</a>
                    <!-- <a href="{{ route('contact') }}">Contact Us</a> -->
                    <a href="{{ route('service') }}">Our Service</a>
                    <a href="{{ route('location') }}">Service Points</a>
                    <a href="{{ route('price') }}">Pricing Plan</a>
                </div>
            </div>
        </div>
                <!-- <div class="col-lg-3 col-md-6"> -->
                    <!-- <div class="footer-link">
                        <h2>Useful Links</h2>
                        <a href="">Terms of use</a>
                        <a href="">Privacy policy</a>
                        <a href="">Cookies</a>
                        <a href="">Help</a>
                        <a href="">FQAs</a>
                    </div> -->
                <!-- </div>
                <div class="col-lg-3 col-md-6"> -->
                    <!-- <div class="footer-newsletter">
                        <h2>Newsletter</h2>
                        <form>
                            <input class="form-control" placeholder="Full Name">
                            <input class="form-control" placeholder="Email">
                            <button class="btn btn-custom">Submit</button>
                        </form>
                    </div> -->
                <!-- </div> -->
        <div class="container copyright">
            <p>&copy; <a href="#">BrightWash Laundry</a>, All Right Reserved. Designed By <a
                    href="https://github.com/TrainerFs3Yuzika/laundry_app">Capstone Group 1</a></p>
        </div>
    </div>
        <!-- Footer End -->
        
        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>

        <!-- Contact Javascript File -->
        <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
        <script src="{{ asset('mail/contact.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('frontend/js/main.js') }}"></script>

    </body>
</html>
