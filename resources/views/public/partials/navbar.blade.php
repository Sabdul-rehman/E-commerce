<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stiched.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">

    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .navbar {
            margin-bottom: 0 !important;
        }


        /* rotation icon */


        /* Global safety */
        html,
        body {
            /* overflow-x: hidden;    */
        }

        .navbar .sticky-top {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1020;
        }


        .fashion-rotate {
            width: 48px;
            height: 48px;
            border: 1.5px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin-right: 8px;
            flex-shrink: 0;
        }

        /* 🔥 FIXED rotating span */
        .fashion-rotate span {
            position: absolute;
            font-size: 7px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;

            /* CRITICAL FIXES */
            max-width: 100%;
            transform-origin: 50% 50%;
            will-change: transform;

            animation: spin 10s linear infinite;
            white-space: nowrap;
        }

        /* Rotation */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="bg-dark text-white text-center py-1 small top-offer">
        🚚 Free Delivery on Orders Above Rs 3000 | 📞 Support: 0300-1234567
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">

            <div class="fashion-rotate">
                <span>Afifa's</span>
            </div>


            <a class="navbar-brand fw-bold" href="/">
                Afifa's<span class="text-danger">Nadias</span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">

                <!-- Left Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stiched') }}">Stitched</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('unstiched') }}">UnStitched</a>
                    </li>
                    <li class="nav-item">   
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Mobiles</a></li>
                            <li><a class="dropdown-item" href="#">Laptops</a></li>
                            <li><a class="dropdown-item" href="#">Accessories</a></li>
                        </ul>
                    </li> --}}
                </ul>

                <!-- Right Side -->
                <div class="d-flex align-items-center gap-3">

                    <!-- Cart -->
                    <a href="/Cart" class="text-dark position-relative">
                        🛒
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            2
                        </span>
                    </a>
                    @guest

                        <!-- Auth Buttons -->
                        <a href="/login" class="btn btn-outline-dark btn-sm">Login</a>
                        <a href="/register" class="btn btn-dark btn-sm">Register</a>

                    @endguest

                    @auth
                        <span>  {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="post" onsubmit="return confirmloutout();">
                            @csrf
                            <button type="submit" onclick="" class="btn btn-dark"> Logout </button>
                        </form>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <script>
        function confirmloutout(){
            return confirm("Are you sure you want to logout?");
        }
    </script>



</body>

</html>