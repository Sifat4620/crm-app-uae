<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@yield('title', '4uhost')</title>
   <meta name="keywords" content="@yield('meta_keywords', '')">
   <meta name="description" content="@yield('meta_description', '')">
   <meta name="author" content="@yield('meta_author', '')">
   <!-- CSS Files -->
   <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
   <link rel="icon" href="{{ asset('frontend/images/fevicon.png') }}" type="image/gif" />
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   @stack('styles')
</head>

<body class="main-layout @yield('body_class')">

   <!-- Loader -->
   <div class="loader_bg">
      <div class="loader">
         <img src="{{ asset('images/loading.gif') }}" alt="Loading..."/>
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

   <!-- JS Files -->
   <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
   <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('frontend/js/custom.js') }}"></script>
   @stack('scripts')
</body>
</html>
