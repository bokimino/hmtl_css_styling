<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Latest Font-Awesome CDN -->
    <script src="https://kit.fontawesome.com/3257d9ad29.js" crossorigin="anonymous"></script>
    <style>
        .roundedInput {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div id="app" class="app">
        <div class="container-fluid px-0">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-3 bg-light">
                    <ul class="nav flex-column">

                        <li class="nav-item w-50 m-auto">
                            <img src="https://picsum.photos/id/1/200/200" class="rounded-circle w-100" alt="">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('discounts.index') }}">Discounts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('brands.index') }}">Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}">Profile</a>
                        </li>
                    </ul>
                </div>
                <!-- Main Content -->
                <div class="col-9 mt-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>