<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>@yield('title', '4uhost')</title>
   <meta name="keywords" content="@yield('meta_keywords', 'web hosting, domain, 4uhost')">
   <meta name="description" content="@yield('meta_description', 'Reliable hosting solutions by 4uhost')">
   <meta name="author" content="@yield('meta_author', '4uhost Team')">

   <!-- Favicon -->
   <link rel="icon" href="{{ asset('frontend/images/fevicon.png') }}" type="image/png" />

   <!-- Core CSS -->
   <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

   <!-- Font Awesome (CDN fallback recommended) -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-Sf3ZG/yyPS27cE7gP+mFyLqu82Z3DQF4QvZs9ASBBEex5xnZOVwVNTJHewh3Ay7e4bP58aR00/7++1j6wF0Tg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Page Specific Styles -->
   @stack('styles')
</head>

<body class="main-layout @yield('body_class')">

   <!-- Loader -->
   <div class="loader_bg">
      <div class="loader">
         <img src="{{ asset('frontend/images/loading.gif') }}" alt="Loading..." />
      </div>
   </div>

   <!-- Header -->
   @include('website.partials.header')

   <!-- Main Content -->
   <main>
      @yield('content')
   </main>

   <!-- Footer -->
   @include('website.partials.footer')

   <!-- Core JS -->
   <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
   <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('frontend/js/custom.js') }}"></script>

   <!-- Page Specific Scripts -->
   @stack('scripts')

</body>
</html>
