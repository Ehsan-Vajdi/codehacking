<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- All CSS-->
    <link href="{{asset('css/fontface.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">

</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="{{route('admin.index')}}">
                        <img src="{{asset('images/icon/logo.png')}}" alt="CoolAdmin" />
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li>
                        <a href="{{route('home')}}"><i class="fas fa-home"></i>Home</a>
                    </li>

                    <!--  only users with administrator privileges are allowed to view, create and edit users list  -->
                    @if(Auth::user()->isAdmin())

                        <li class="has-sub">
                            <a class="js-arrow" href="#"><i class="fas fa-users"></i>Users
                                <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                            </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('users.index')}}">All Users</a>
                                </li>
                                <li>
                                    <a href="{{route('users.create')}}">Create User</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <!--  /end administrator privileges  -->

                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-users"></i>Posts
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="{{route('posts.index')}}">All Posts</a>
                            </li>
                            <li>
                                <a href="{{route('posts.create')}}">Create Post</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="">
                            <i class="fas fa-chart-bar"></i>Charts</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="{{route('admin.index')}}">
                <img src="{{asset('images/icon/logo.png')}}" alt="Cool Admin" />
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a href="{{route('home')}}"><i class="fas fa-home"></i>Home</a>
                    </li>

                    <!--  only users with administrator privileges are allowed to view, create and edit users list  -->
                    @if(Auth::user()->isAdmin())

                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-users"></i>Users
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="navbar__sub-list list-unstyled js-sub-list">
                            <li>
                                <a href="{{route('users.index')}}">All Users</a>
                            </li>
                            <li>
                                <a href="{{route('users.create')}}">Create User</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <!--  /end administrator privileges  -->

                    <li class="has-sub has-dropdown">
                        <a class="js-arrow" href="#"><i class="fas fa-folder"></i>Posts
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{route('posts.index')}}">All Posts</a>
                            </li>
                            <li>
                                <a href="{{route('posts.create')}}">Create Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="">
                            <i class="fas fa-chart-bar"></i>Charts</a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">
                            <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <div class="header-button">

                            <div class="noti-wrap"></div>

                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu justify-content-end">
                                    <div class="image">
                                        <img src="{{Auth::user()->photo_id ? asset(Auth::user()->photo->file) : 'http://placehold.it/400x400'}}" alt="user_image" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{Auth::user()->photo_id ? asset(Auth::user()->photo->file) : 'http://placehold.it/400x400'}}" alt="{{Auth::user()->name}}" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#">{{Auth::user()->name}}</a>
                                                </h5>
                                                <span class="email">{{Auth::user()->email}}</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="{{route('users.edit', Auth::user()->id)}}">
                                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i>{{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

</div>

@yield('footer')

<!-- All JS-->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
<!-- end document-->
