<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/lib/owlcarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/lib/owlcarousel/dist/assets/owl.carousel.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
</head>

<body>



    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <nav class="p-0 collapse position-absolute navbar navbar-vertical navbar-light align-items-start bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <div class="nav-item dropdown dropright">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dresses <i class="float-right mt-1 fa fa-angle-right"></i></a>
                            <div class="m-0 border-0 dropdown-menu position-absolute rounded-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="px-0 py-3 navbar navbar-expand-lg bg-dark navbar-dark py-lg-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="px-2 h1 text-uppercase text-dark bg-light">Multi</span>
                        <span class="px-2 h1 text-uppercase text-light bg-primary ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="py-0 mr-auto navbar-nav">
                            <a href="{{route('user#home')}}" class="nav-item nav-link">Home</a>
                            <a href="{{route('user#cartList')}}" class="nav-item nav-link">My Cart</a>
                            <a href="{{route('contact#showList')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="py-0 ml-auto navbar-nav d-none d-lg-block">
                            {{-- <a href="" class="px-0 btn">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="border badge text-secondary border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="" class="px-0 ml-3 btn">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="border badge text-secondary border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a> --}}

                            <div class="dropdown d-inline me-5">
                                <a class="btn btn-dark dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user text-warning"></i>
                                <span class="text-white">{{ Auth::user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu">
                                  <li><a class="my-3 dropdown-item" href="{{route('user#accountChangePage')}}"><i class="fa-solid fa-user me-1"></i>Account</a></li>
                                  <li><a class="my-3 dropdown-item" href="{{ route('user#changePasswordPage') }}"><i class="fa-solid fa-key me-1"></i>Change password</a></li>
                                  <li>
                                    <span class="dropdown-item" href="#">
                                        <form action="{{route('logout')}}" method="post">
                                            @csrf
                                            <button class="btn btn-dark">
                                                <i class="fa-solid fa-right-from-bracket text-warning"></i>
                                                <span>Logout</span>
                                            </button>
                                        </form>
                                    </span>
                                </li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->





    @yield('content')


    <!-- Footer Start -->
    <div class="pt-5 mt-5 container-fluid bg-dark text-secondary">
        <div class="pt-5 row px-xl-5">
            <div class="pr-3 mb-5 col-lg-4 col-md-12 pr-xl-5">
                <h5 class="mb-4 text-secondary text-uppercase">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="mr-3 fa fa-map-marker-alt text-primary"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="mr-3 fa fa-envelope text-primary"></i>info@example.com</p>
                <p class="mb-0"><i class="mr-3 fa fa-phone-alt text-primary"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Home</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our Shop</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop Detail</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Home</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Our Shop</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shop Detail</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Shopping Cart</a>
                            <a class="mb-2 text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="mr-2 fa fa-angle-right"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="mb-5 col-md-4">
                        <h5 class="mb-4 text-secondary text-uppercase">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="mt-4 mb-3 text-secondary text-uppercase">Follow Us</h6>
                        <div class="d-flex">
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="mr-2 btn btn-primary btn-square" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4 row border-top mx-xl-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="text-center mb-md-0 text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="text-center col-md-6 px-xl-0 text-md-right">
                <img class="img-fluid" src="" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>

    <script src="{{ asset('user/lib/owlcarousel/dist/owl.carousel.min.js') }}"></script>
    <!-- Contact Javascript File -->
    <script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('user/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js') }}"></script>
</body>

@yield('scriptSource')

</html>
