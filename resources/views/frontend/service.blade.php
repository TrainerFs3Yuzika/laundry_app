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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" >
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
                                        <!-- Mengubah ikon menjadi tombol -->
                                        <a href="https://wa.me/6285728996499" target="_blank" class="btn btn-icon">
                                            <i class="fa fa-phone-alt"></i>
                                        </a>
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
                            <a href="#" class="nav-item nav-link active">Service</a>
                            <a href="{{ route('price') }}" class="nav-item nav-link">Price</a>
                            <a href="#" class="nav-item nav-link">Laundry Points</a>
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
                        <h2>Service</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Service</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->
        
        
        <!-- Service Start -->
        <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <p>What We Do?</p>
                <h2>Premium Washing Services</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash-1"></i>
                        <h3>Standard Laundry Service</h3>
                        <p>Wash, Dry, and Fold</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash"></i>
                        <h3>Dry Cleaning</h3>
                        <p>Professional Care for Delicate Garments</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-vacuum-cleaner"></i>
                        <h3>Specialty Services</h3>
                        <p>Stain Removal</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-seat"></i>
                        <h3>Free Laundry Bag</h3>
                        <p>Every purchase comes with a laundry bag from Bright Wash Laundry.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-service"></i>
                        <h3>Commercial Laundry</h3>
                        <p>Tailored Solutions for Businesses</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-service-2"></i>
                        <h3>Eco-Friendly Laundry</h3>
                        <p>Sustainable Cleaning Solutions</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-car-wash"></i>
                        <h3>Household Items</h3>
                        <p>Curtains and Drapes</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="flaticon-brush-1"></i>
                        <h3>Premium Services</h3>
                        <p>Express Service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Service End -->
        
        
        <!-- Testimonial Start -->
        <!-- <div class="testimonial">
            <div class="container">
                <div class="section-header text-center">
                    <p>Testimonial</p>
                    <h2>What our clients say</h2>
                </div>
                <div class="owl-carousel testimonials-carousel">
                    <div class="testimonial-item">
                        <img src="img/testimonial-1.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-2.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-3.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="img/testimonial-4.jpg" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client Name</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Testimonial End -->


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
