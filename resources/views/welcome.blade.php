<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Limmerz is an ecommerce solution for both grocery and lifestyle based on laravel and vue.js">
    <meta name="keywords" content="Limmex Groce, grocery, ecommerce, home applience, lacommerz, lacommerz, La commerz, La commerz, Limmex ecommerce, Limmex ecommerce, Limmex Automation, Limmex Automation, limmerz">
    <meta name="author" content="Limmex Automation">
    <meta name="sitemap_link" content="sitemap.com">
    <meta property="og:site_name" content="Limmerz" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="Ll16npcBq7S9K9o5pF0cegaJ8bfB8nuhjSDUkMHJ">
        <!-- Twitter Card  -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Grocers | Start Your Own Ecommerce Today">
    <meta name="twitter:site" content="@shakhawat_fci">
    <meta name="twitter:creator" content="@shakhawat_fci">
    <meta name="twitter:description" content="Grocers is an ecommerce solution for both grocery and lifestyle based on laravel and vue.js">
    <meta name="twitter:image" content="images/setting/seo/5ed50b0000acd.jpg">

    <!-- Open Graph  -->
    <meta property="og:title" content="Grocers | Start Your Own Ecommerce Today" />
    <meta property="og:type" content="Ecommerce Site" />
    <meta property="og:url" content="index.html" />
    <meta property="og:image" content="images/setting/seo/5ed50b0000acd.jpg" />
    <meta property="og:description" content="Grocers is an ecommerce solution for both grocery and lifestyle based on laravel and vue.js" />

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/fav.png') }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--line icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/LineIcons.min.css') }}">
    <!--style css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!--setting css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/setting.css') }}">
    <!--responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">   
     <!--responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">
    <!--google font css-->
    <link href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap" rel="stylesheet">
   
</head>
<body>
    
    <div id="app">
        <main-app></main-app>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--jquery js-->
    <script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
    <!--boostrap js-->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!--popper js-->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <!--swiper js-->
    <script src="{{ asset('assets/js/jquery.elevatezoom.j') }}s"></script>
    <!--magnific js-->
    <script src="{{ asset('assets/js/magnific.js') }}"></script>
    <!--main js-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
