<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    
    <!-- Link to local CSS files -->
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet"> <!-- Font Awesome -->
    <link href="{{ asset('assets/css/linea.css') }}" rel="stylesheet"> <!-- Linea Icons -->
    <!-- Link to Linea Icons CSS via CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/linea-icons/2.0.0/linea.css" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> <!-- Your custom styles -->
    
    <!-- Modernizr (for feature detection) -->
    <script src="{{ asset('js/modernizr.3.6.0.min.js') }}"></script>
    @yield('customStyle')
</head>

<body class="v-light compact-nav fix-header fix-sidebar">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        <!-- Sidebar -->
        @include('main.sidebar') <!-- This includes the sidebar -->
        
        <!-- Header -->
        @include('main.header') <!-- This includes the header -->

        <!-- Main Content Area -->
        <main>
            @yield('content') <!-- This is where your page-specific content will be inserted -->
        </main>
    </div>

    <!-- Local JavaScript files -->
    <!-- Common JS -->
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    
    <!-- Custom script -->
    <script src="{{ asset('js/custom.mini.nav.js') }}"></script>
    
    <!-- Chart.js library -->
    <script src="{{ asset('assets/plugins/chartjs/Chart.bundle.js') }}"></script>
    
    <!-- Custom dashboard script -->
    <script src="{{ asset('js/dashboard.1.js') }}"></script>
    @yield('customScript')
</body>

</html>
