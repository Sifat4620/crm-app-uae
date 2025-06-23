<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
      <div class="container">
         <a class="navbar-brand font-weight-bold d-flex align-items-center" href="{{ url('/') }}">
            <i class="fa fa-server text-primary f-s-20 mr-2"></i> <!-- Added custom size and margin -->
            CRMS Website
         </a>

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto align-items-center">
               <li class="nav-item icons">
                  <a class="nav-link d-flex align-items-center" href="{{ url('/') }}">
                     <i class="fa fa-home f-s-16 mr-1"></i> Home
                  </a>
               </li>

               <li class="nav-item icons">
                  <a class="nav-link d-flex align-items-center" href="{{ route('hosting') }}">
                     <i class="fa fa-cloud f-s-16 mr-1"></i> Hosting
                  </a>
               </li>

               <li class="nav-item icons">
                  <a class="nav-link d-flex align-items-center" href="{{ url('/about') }}">
                     <i class="fa fa-info-circle f-s-16 mr-1"></i> About
                  </a>
               </li>

               <li class="nav-item icons">
                  <a class="nav-link d-flex align-items-center" href="{{ url('/contact') }}">
                     <i class="fa fa-envelope f-s-16 mr-1"></i> Contact
                  </a>
               </li>

               <!-- Cart Icon -->
               <li class="nav-item mx-2 icons position-relative">
                  <a class="nav-link d-flex align-items-center position-relative" href="{{ url('/cart') }}">
                     <i class="fa fa-shopping-cart f-s-16"></i>
                     <span class="badge badge-pill badge-danger position-absolute" style="top: 0; right: 0; font-size: 10px;">2</span>
                  </a>
               </li>

               <!-- Login / Dashboard Icon -->
               <li class="nav-item icons">
                  @auth
                     <a class="nav-link d-flex align-items-center" href="{{ url('/dashboard') }}">
                        <i class="fa fa-user-circle f-s-16 mr-1"></i> Dashboard
                     </a>
                  @else
                     <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                        <i class="fa fa-sign-in f-s-16 mr-1"></i> Login
                     </a>
                  @endauth
               </li>
            </ul>
         </div>
      </div>
   </nav>
</header>
