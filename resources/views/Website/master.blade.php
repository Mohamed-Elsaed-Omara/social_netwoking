<!DOCTYPE html>
<html>
<head>
    <title>Social Networking</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo/favourite_icon_01.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</head>

<body>
    <header class="header_section furniture_header sticky_header clearfix">
        <div class="header_content_wrap d-flex align-items-center clearfix" style="height: 50px">
            <div class="container-fluid prl_50">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-4">
                        <a href="{{ url('/news-feed') }}">
                            <h1>News Feed</h1>
                        </a>
                    </div>
                    <div class="col-lg-1 text-center">
                        <a class="nav-link" href="{{ url('/users') }}">
                            <i class="fas fa-users"></i> People
                        </a>
                    </div>
                    <div class="col-lg-1 text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/FriendShipRequests') }}">
                                <i class="fas fa-user-friends"></i> Friends Requests
                            </a>
                        </li>
                    </div>
                    <div class="col-lg-2 text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/Friends') }}">
                                <i class="fas fa-user-friends"></i> Friends
                            </a>
                        </li>
                    </div>
                    <div class="col-lg-4">
                        <ul class="action_btns_group ul_li_right clearfix float-right">
                            <li>
                                <button type="button" class="user_btn" data-toggle="collapse" data-target="#user_dropdown" aria-expanded="false" aria-controls="user_dropdown">
                                    <i class="fal fa-user"></i>
                                </button>
                                <div id="user_dropdown" class="collapse_dropdown collapse">
                                    <div class="dropdown_content">
                                        <div class="profile_info clearfix">
                                            <div class="user_thumbnail">
                                                <img src="{{ asset(auth()->user()->image) }}" alt="thumbnail_not_found">
                                            </div>
                                            <div class="user_content">
                                                <a href="{{ url('/profile') }}">
                                                    <h4 class="user_name">{{ Auth::user()->name }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                        <ul class="settings_options ul_li_block clearfix">
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fal fa-sign-out-alt"></i> Logout
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <button type="button" class="notification_btn" id="notification_btn">
                                    <i class="fas fa-bell"></i>
                                    <span id="notification_count" class="badge badge-danger">0</span>
                                </button>
                                <div id="notification_dropdown" class="dropdown-menu dropdown-menu-right" style="display: none;">
                                    <div class="dropdown-content">
                                        <ul id="notification_list" class="ul_li_block clearfix">
                                            
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <script>
        var user_id = "{{ Auth::id() }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/mCustomScrollbar.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
    <script src="assets/js/gmaps.min.js"></script>
    <script src="{{ asset('assets/js/parallaxie.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    
</body>
</html>
