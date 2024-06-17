<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BrightWash Laundry</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/lib/flaticon/font/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

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
                        <a href="#">
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
                                    <p>brightwas@laundry.com</p>
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
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
                        <a href="{{ route('service') }}" class="nav-item nav-link">Service</a>
                        <a href="{{ route('price') }}" class="nav-item nav-link">Price</a>
                        <a href="{{ route('location') }}" class="nav-item nav-link">Washing Points</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('blog') }}" class="dropdown-item">Blog Grid</a>
                                <a href="{{ route('single') }}" class="dropdown-item">Detail Page</a>
                                <a href="{{ route('team') }}" class="dropdown-item">Team Member</a>
                                <a href="{{ route('booking') }}" class="dropdown-item">Schedule Booking</a>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                    </div>
                    @guest
                        <div class="ml-auto">
                            <a class="btn btn-custom" href="{{ route('login') }}">Get Appointment</a>
                        </div>
                    @else
                        <div class="ml-auto">
                            @if (Auth::user()->role == 'admin')
                                <a class="btn btn-custom" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @elseif(Auth::user()->role == 'customer')
                                <a class="btn btn-custom" href="{{ route('customer.dashboard.index') }}">Dashboard</a>
                            @endif
                        </div>

                    @endguest
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->


    <!-- Carousel Start -->
    <div class="carousel">
        <div class="container-fluid">
            <div class="owl-carousel">
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img/carousel-1.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Cleaning</h3>
                        <h1>Keep Apparel Newer</h1>
                        <p>
                            Preserve your favorite clothes with our expert laundry service. Say goodbye to fading colors
                            and worn-out fabrics!
                        </p>
                        <a class="btn btn-custom" href="{{ route('about') }}">Explore More</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Cleaning</h3>
                        <h1>Quality service for you</h1>
                        <p>
                            Experience top-notch laundry care tailored just for you. Let us handle the details while you
                            enjoy fresh, clean clothes hassle-free.
                        </p>
                        <a class="btn btn-custom" href="">Explore More</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-img">
                        <img src="{{ asset('frontend/img/carousel-3.jpg') }}" alt="Image">
                    </div>
                    <div class="carousel-text">
                        <h3>Washing & Cleaning</h3>
                        <h1>Quick Laundry, Easier Life</h1>
                        <p>
                            Simplify your life with our swift laundry service. Say goodbye to hassle and hello to
                            convenience!
                        </p>
                        <a class="btn btn-custom" href="">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('frontend/img/about.jpg') }}" alt="Image">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-header text-left">
                        <p>About Us</p>
                        <h2>washing and cleaning</h2>
                    </div>
                    <div class="about-content">
                        <p>
                            At BrightWash Laundry, we believe that a clean wardrobe leads to a brighter day. Established
                            with the goal of providing top-notch laundry services, we are dedicated to delivering
                            excellence in every garment we handle.
                        </p>
                        <ul>
                            <li><i class="far fa-check-circle"></i>Quality</li>
                            <li><i class="far fa-check-circle"></i>Convenience</li>
                            <li><i class="far fa-check-circle"></i>Customer Satisfaction</li>
                            <li><i class="far fa-check-circle"></i>Eco-Friendly Practices</li>
                        </ul>
                        <a class="btn btn-custom" href="{{ route('about') }}">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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
                        <h3>Seats Washing</h3>
                        <p>Lorem ipsum dolor sit amet elit. Phase nec preti facils ornare velit non metus tortor</p>
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


    <!-- Facts Start -->
    <div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-map-marker-alt"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">5</h3>
                            <p>Service Points</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-user"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">30</h3>
                            <p>Staff & Workers</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-users"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">1500</h3>
                            <p>Happy Clients</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="fa fa-check"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">5000</h3>
                            <p>Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Price Start -->
    <div class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Washing Plan</p>
                <h2>Choose Your Plan</h2>
            </div>
            <div class="row justify-content-center">
                @php
                    // Filter layanan yang aktif
                    $activeServices = $services->filter(function ($service) {
                        return $service->status === 'active';
                    });
                    $count = $activeServices->count();

                    // Cari layanan dengan deskripsi paling lengkap
                    $mostCompleteService = $activeServices
                        ->sortByDesc(function ($service) {
                            return count($service->description);
                        })
                        ->first();
                    $mostCompleteDescriptions = $mostCompleteService ? $mostCompleteService->description : [];

                    // Tentukan indeks layanan tengah
                    $middleIndex = intval($count / 2);
                @endphp
                @foreach ($activeServices as $index => $service)
                    <div class="col-md-{{ $count == 1 ? '6 offset-md-3' : ($count == 2 ? '6' : '4') }}">
                        <div class="price-item {{ $index == $middleIndex ? 'price-item featured-item' : '' }}">
                            <div class="price-header">
                                <h3>{{ $service->name_service }}</h3>
                                <h2><strong>{{ formatRupiah($service->price) }}</strong></h2>
                            </div>
                            <div class="price-body">
                                <ul>
                                    @php
                                        // Pastikan $service->description adalah array
                                        $descriptions = $service->description;

                                        // Tambahkan deskripsi dari layanan paling lengkap jika kurang dari 5
                                        if (count($descriptions) < 5) {
                                            foreach ($mostCompleteDescriptions as $desc) {
                                                if (count($descriptions) >= 5) {
                                                    break;
                                                }
                                                if (!in_array($desc, $descriptions)) {
                                                    $descriptions[] = $desc;
                                                }
                                            }
                                        }
                                    @endphp
                                    @foreach ($descriptions as $key => $desc)
                                        <li>
                                            <i
                                                class="{{ $key < count($service->description) ? 'far fa-check-circle' : 'far fa-times-circle' }}"></i>{{ $desc }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="price-footer">
                                <a class="btn btn-custom" href="{{ route('customer.orders') }}">Book Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Price End -->


    <!-- Location Start -->
    <div class="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section-header text-left">
                        <p>Laundry Points</p>
                        <h2>BrightWas Laundry</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Laundry Point</h3>
                                    <p>123 Street, Semarang, Indonesia</p>
                                    <p><strong>Call:</strong>+628 5728 9964 99</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Laundry Point</h3>
                                    <p>123 Street, Bandung, Indonesia</p>
                                    <p><strong>Call:</strong>+628 5728 9964 99</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>laundry Point</h3>
                                    <p>123 Street, Jakarta, Indonesia</p>
                                    <p><strong>Call:</strong>+628 5728 9964 99</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="fa fa-map-marker-alt"></i>
                                <div class="location-text">
                                    <h3>Laundry Point</h3>
                                    <p>123 Street, Tangerang, Indonesia</p>
                                    <p><strong>Call:</strong>+628 5728 9964 99</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="location-form">
                        <h3>Request for a brightwas laundry</h3>
                        <form>
                            <div class="control-group">
                                <input type="text" class="form-control" placeholder="Name" required="required" />
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" placeholder="Email"
                                    required="required" />
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" placeholder="Description" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-custom" type="submit">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location End -->


    <!-- Team Start -->
    <div class="team">
        <div class="container">
            <div class="section-header text-center">
                <p>Meet Our Team</p>
                <h2>Our Staff & Workers</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img/team-1.jpg') }}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Donald John</h2>
                            <p>Engineer</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img/team-2.jpg') }}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Adam Phillips</h2>
                            <p>Engineer</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img/team-3.jpg') }}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Thomas Olsen</h2>
                            <p>Worker</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{ asset('frontend/img/team-4.jpg') }}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>James Alien</h2>
                            <p>Worker</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="section-header text-center">
                <p>Testimonial</p>
                <h2>What our clients say</h2>
            </div>
            <div class="owl-carousel testimonials-carousel">
                @foreach ($ratings as $rating)
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/img/testimonial-1.jpg') }}" alt="Image">
                        <div class="testimonial-text">
                            <h3>{{ $rating->user->name }}</h3>
                            <h4>{{ $rating->user->email }}</h4>
                            <div class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $rating->rating)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="gold" class="bi bi-star-fill mr-1" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="lightgray" class="bi bi-star-fill mr-1" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p>
                                {{ $rating->review }}
                            </p>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="testimonial-item">
                        <img src="{{ asset('frontend/img/testimonial-2.jpg') }}" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client 2</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu
                                metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/img/testimonial-3.jpg') }}" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client 3</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu
                                metus tortor auctor gravid
                            </p>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <img src="{{ asset('frontend/img/testimonial-4.jpg') }}" alt="Image">
                        <div class="testimonial-text">
                            <h3>Client 4</h3>
                            <h4>Profession</h4>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasel preti mi facilis ornare velit non vulputa. Aliqu
                                metus tortor auctor gravid
                            </p>
                        </div>
                    </div> --}}
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="blog">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Blog</p>
                <h2>Latest news & articles</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img/carousel-1.jpg') }}" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2024</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam
                                eleife. Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue
                                eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2024</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam
                                eleife. Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue
                                eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('frontend/img/carousel-3.jpg') }}" alt="Image">
                            <div class="meta-date">
                                <span>01</span>
                                <strong>Jan</strong>
                                <span>2024</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Pellent iaculis blandit lorem, quis convall diam
                                eleife. Nam in arcu sit amet massa ferment quis enim. Nunc augue velit metus congue
                                eget semper
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">Admin</a></p>
                            <p><i class="fa fa-folder"></i><a href="">Web Design</a></p>
                            <p><i class="fa fa-comments"></i><a href="">15 Comments</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-contact">
                        <h2>Get In Touch</h2>
                        <p><i class="fa fa-map-marker-alt"></i>123 Street, Semarang, Indonesia</p>
                        <p><i class="fa fa-phone-alt"></i>+628 5728 9964 99</p>
                        <p><i class="fa fa-envelope"></i>brightwas@laundry.com</p>
                        <div class="footer-social">
                            <a class="btn" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-link">
                        <h2>Popular Links</h2>
                        <a href="{{ route('about') }}">About Us</a>
                        <a href="{{ route('contact') }}">Contact Us</a>
                        <a href="{{ route('service') }}">Our Service</a>
                        <a href="{{ route('location') }}">Service Points</a>
                        <a href="{{ route('price') }}">Pricing Plan</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-link">
                        <h2>Useful Links</h2>
                        <a href="">Terms of use</a>
                        <a href="">Privacy policy</a>
                        <a href="">Cookies</a>
                        <a href="">Help</a>
                        <a href="">FQAs</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-newsletter">
                        <h2>Newsletter</h2>
                        <form>
                            <input class="form-control" placeholder="Full Name">
                            <input class="form-control" placeholder="Email">
                            <button class="btn btn-custom">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
