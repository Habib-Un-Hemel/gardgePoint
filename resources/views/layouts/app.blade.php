<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gardge Point</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap and CSS files with proper asset paths -->
    <link rel="stylesheet" href="{{ asset('css/css_temp/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_temp/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_temp/responsive.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="icon" href="{{ asset('css/images/fevicon.png') }}" type="image/gif" />
    @yield('styles')
    
</head>

<body class="main-layout">
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="{{ url('/') }}">Gardge Point</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/book-appointment') }}">Book Appointment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/track') }}">Track Appointment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/contact-admin') }}">Contact Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/dashboard') }}">Admin Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/admin/login') }}">Admin Login</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header inner -->
    <!-- end header -->

    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer id="contact">
        <div class="footer">
           <div class="container">
              <div class="row align-items-center">
                 <div class="col-md-4">
                    <div class="titlepage">
                       <h2>Contact Us</h2>
                    </div>
                 </div>
              </div>
           </div>

           <div class="social_container">
            <ul class="social_icon">
               <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
         </div>

         <div class="col-md-8">
            <ul class="location_icon">
               <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>Bangladesh</li>
               <li><a href="#"><i class="fa fa-volume-control-phone" aria-hidden="true"></i></a>0171210858</li>
               <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>GardgePoint@gmail.com</li>
            </ul>
         </div>

           <div class="copyright">
              <div class="container">
                 <div class="row">
                    <div class="col-md-12">
                       <p>Copyright 2025 All Right Reserved By <a href="#">Hemel</a></p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </footer>
     <!-- end footer -->

    <!-- JavaScript files with proper asset paths -->
    <script src="{{ asset('js/js_temp/jquery.min.js') }}"></script>
    <script src="{{ asset('js/js_temp/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/js_temp/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('js/js_temp/custom.js') }}"></script>
    @yield('scripts')
</body>
</html>
