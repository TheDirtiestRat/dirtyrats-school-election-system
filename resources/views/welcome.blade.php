<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@include('components.app-name')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{-- <link href="favicon.png" rel="icon"> --}}
    {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

    <!-- Google Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"> --}}

    <!-- Vendor CSS Files -->
    {{-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('storage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('storage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    @vite(['resources/js/app.js', 'resources/js/nova.js'])
    <link href="{{ asset('storage/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="page-index">

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="d-flex align-items-center">@include('components.app-name')</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="#hero" class="active">Welcome</a></li>
                    {{-- <li><a href="#instruction">Instructions</a></li> --}}
                    <li><a href="#services-list">Candidates To Vote</a></li>
                    {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li> --}}
                    <li><a href="{{ url('login') }}">Log-in</a></li>
                    {{-- <li><a href="{{ url('registerNewVoter') }}">Register</a></li> --}}
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <h2 data-aos="fade-up">Welcome to ACLC Voting System</h2>
                    <blockquote data-aos="fade-up" data-aos-delay="100">
                        <p>
                            Vote for your choosen Nominees to run for this ACLC COLLEGE Election
                            and always be mindful of who to vote.
                        </p>
                        <!-- <p>Vote for your choosen candidates to run for this @include('components.app-name') Elections
                            and always be mindful of who to vote for they are the ones that will steer you to the
                            future. </p> -->
                    </blockquote>
                    <div class="d-block" data-aos="fade-up" data-aos-delay="200">
                        {{-- <a href="{{ url('registerNewVoter') }}" class="btn-get-started m-1 ">Register Now</a> --}}
                        <a href="#services-list" class="btn-get-started m-1 ">Candidates</a>
                        <a href="{{ url('login') }}" class="btn-get-started m-1 ">Vote Now!</a>
                    </div>
                    {{-- <a href="#" class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                    {{-- <div class="d-flex mt-4">

                    </div>
                    <div class="d-flex mt-4">

                    </div> --}}
                </div>
            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Why Choose Us Section ======= -->
        {{-- <section id="instruction" class="why-us">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Instructions To Register</h2>

                </div>

                <div class="row g-0" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-xl-5 img-bg"
                        style="background-image: url('{{ asset('storage/assets/img/why-us-bg.jpg') }}')"></div>
                    <div class="col-xl-7 slides  position-relative">

                        <div class="slides-1 swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="item">
                                        <h3 class="mb-3">Let's grow your business together</h3>
                                        <h4 class="mb-3">Optio reiciendis accusantium iusto architecto at quia minima
                                            maiores quidem, dolorum.</h4>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, ipsam
                                            perferendis asperiores explicabo vel tempore velit totam, natus nesciunt
                                            accusantium dicta quod quibusdam ipsum maiores nobis non, eum. Ullam
                                            reiciendis dignissimos laborum aut, magni voluptatem velit doloribus quas
                                            sapiente optio.</p>
                                    </div>
                                </div><!-- End slide item -->

                                <div class="swiper-slide">
                                    <div class="item">
                                        <h3 class="mb-3">Unde perspiciatis ut repellat dolorem</h3>
                                        <h4 class="mb-3">Amet cumque nam sed voluptas doloribus iusto. Dolorem eos
                                            aliquam quis.</h4>
                                        <p>Dolorem quia fuga consectetur voluptatem. Earum consequatur nulla maxime
                                            necessitatibus cum accusamus. Voluptatem dolorem ut numquam dolorum delectus
                                            autem veritatis facilis. Et ea ut repellat ea. Facere est dolores fugiat
                                            dolor.</p>
                                    </div>
                                </div><!-- End slide item -->

                                <div class="swiper-slide">
                                    <div class="item">
                                        <h3 class="mb-3">Aliquid non alias minus</h3>
                                        <h4 class="mb-3">Necessitatibus voluptatibus explicabo dolores a vitae
                                            voluptatum.</h4>
                                        <p>Neque voluptates aut. Soluta aut perspiciatis porro deserunt. Voluptate ut
                                            itaque velit. Aut consectetur voluptatem aspernatur sequi sit laborum.
                                            Voluptas enim dolorum fugiat aut.</p>
                                    </div>
                                </div><!-- End slide item -->

                                <div class="swiper-slide">
                                    <div class="item">
                                        <h3 class="mb-3">Necessitatibus suscipit non voluptatem quibusdam</h3>
                                        <h4 class="mb-3">Tempora quos est ut quia adipisci ut voluptas. Deleniti
                                            laborum soluta nihil est. Eum similique neque autem ut.</h4>
                                        <p>Ut rerum et autem vel. Et rerum molestiae aut sit vel incidunt sit at
                                            voluptatem. Saepe dolorem et sed voluptate impedit. Ad et qui sint at qui
                                            animi animi rerum.</p>
                                    </div>
                                </div><!-- End slide item -->

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>

            </div>
        </section><!-- End Why Choose Us Section --> --}}

        <!-- ======= Our Services Section ======= -->
        <section id="services-list" class="services-list">
            <div class="container" data-aos="fade-up">

                @forelse ($positions as $pos)
                    {{-- Positions --}}
                    <div class="section-header">
                        <h2>{{ $pos->name }}</h2>
                    </div>

                    {{-- Candidates --}}
                    <div class="row gy-5 justify-content-center">
                        @forelse ($candidates as $can)
                            @if ($can->position == $pos->name)
                                <div class="col-lg-4 col-md-6 service-item" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon flex-shrink-0 text-center">
                                        {{-- <i class="bi bi-briefcase" style="color: #f57813;"></i> --}}
                                        <img src="{{ asset('storage/candidate img/' . $can->photo) }}" alt=""
                                            class="m-2 shadow rounded-3" width="150px" height="150px">
                                    </div>
                                    <div>
                                        <h4 class="title text-center"><a href="#"
                                                class="stretched-link">{{ $can->name }}
                                            </a></h4>
                                        <p class="description">
                                        <ul>
                                            {{-- list of infos --}}
                                            @foreach ($infos as $info)
                                                @if ($info->candidate_id == $can->id)
                                                    <li><strong>{{ $info->kind }} :</strong> {{ $info->info }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-md-6">
                                <div class="card mb-3 shadow  text-center">
                                    <div class="card-body">
                                        <h5 class="card-title text-muted">
                                            No Candidate listed
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                @empty
                    <div class="section-header text-muted ">
                        <h2>No Spots Open Yet</h2>
                    </div>
                @endforelse


            </div>
        </section><!-- End Our Services Section -->

        <!-- ======= Call To Action Section ======= -->
        <section id="call-to-action" class="call-to-action">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h3>Register Now</h3>
                        <p>What are you waiting for Register now to vote for your choosen candidates.</p>
                        <a class="cta-btn" href="{{ url('registerNewVoter') }}">Call To Action</a>
                    </div>
                </div>

            </div>
        </section><!-- End Call To Action Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">

            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                        <h3>Powerful Features for <br>@include('components.app-name')</h3>

                        <div class="row gy-4">

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-store-line" style="color: #ffbb2c;"></i>
                                    <span>Easy Voting Process</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                                    <span>Realtime results</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
                                    <span>Straight forward Registering Process</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
                                    <span>Quality of life changes</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            {{-- <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-database-2-line" style="color: #47aeff;"></i>
                                    <span>Easy Cart Features</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
                                    <span>Sit amet consectetur adipisicing</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
                                    <span>Ipsum Rerum Explicabo</span>
                                </div>
                            </div><!-- End Icon List Item-->

                            <div class="col-md-6">
                                <div class="icon-list d-flex">
                                    <i class="ri-base-station-line" style="color: #ff5828;"></i>
                                    <span>Easy Cart Features</span>
                                </div>
                            </div><!-- End Icon List Item--> --}}
                        </div>
                    </div>
                    <div class="col-lg-5 position-relative" data-aos="fade-up" data-aos-delay="200">
                        <div class="phone-wrap">
                            <img src="{{ asset('storage/assets/img/iphone.png') }}" alt="Image"
                                class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>

            <div class="details">
                <div class="container" data-aos="fade-up" data-aos-delay="300">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Hi there!<br>What are you waiting for?</h4>
                            <p>Vote now for your choosen candidates</p>
                            <a href="{{ url('registerNewVoter') }}" class="btn-get-started">Get Started</a>
                        </div>
                    </div>

                </div>
            </div>

        </section><!-- End Features Section -->


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span>@include('components.app-name')</span>
                        </a>
                        <p>A voting system for the school.</p>
                        <div class="social-links d-flex  mt-3">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="#">Home</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">About us</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Services</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bi bi-dash"></i> <a href="#">Web Design</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Web Development</a></li>
                            <li><i class="bi bi-dash"></i> <a href="#">Product Management</a></li>
                            {{-- <li><i class="bi bi-dash"></i> <a href="#">Marketing</a></li> --}}
                            <li><i class="bi bi-dash"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            {{-- A108 Adam Street <br> --}}
                            Lilia Avenue. BRGY. Cogon Ormoc City<br>
                            {{-- United States <br><br> --}}
                            <strong>Phone:</strong> 09xx xxx xxxx<br>
                            <strong>Email:</strong> dunhill.bugatan.leal@gmail.com<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="footer-legal">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>@include('components.app-name')</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Developed by <a href="https://www.tiktok.com/@thedirtiestrat">Mr. Dirtiest Rat (Dunhill Leal)</a>
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>
    </footer><!-- End Footer --><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

    <script src="{{ asset('storage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('storage/assets/vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>

    <!-- Template Main JS File -->
    {{-- <script src="assets/js/main.js"></script> --}}

</body>

</html>
