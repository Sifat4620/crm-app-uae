<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
      <div class="container">
         <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">
            <i class="fa fa-server text-primary"></i> CRMS Website
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
               <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ route('hosting') }}"><i class="fa fa-cloud"></i> Hosting</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}"><i class="fa fa-info-circle"></i> About</a></li>
               <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}"><i class="fa fa-envelope"></i> Contact</a></li>

               <!-- Cart Icon -->
               <li class="nav-item mx-2">
                  <a class="nav-link position-relative" href="{{ url('/cart') }}">
                     <i class="fa fa-shopping-cart"></i>
                     <span class="badge badge-pill badge-danger position-absolute" style="top: 0; right: 0; font-size: 10px;">2</span>
                  </a>
               </li>

               <!-- Login Icon -->
               <li class="nav-item">
                  @auth
                     <a class="nav-link" href="{{ url('/dashboard') }}">
                        <i class="fa fa-user-circle"></i> Dashboard
                     </a>
                  @else
                     <a class="nav-link" href="{{ route('login') }}">
                        <i class="fa fa-sign-in"></i> Login
                     </a>
                  @endauth
               </li>
            </ul>
         </div>
      </div>
   </nav>
</header>
