@extends('website.layouts.main')

@section('title', '4uhost - Home')

@section('content')

<!-- Hero Section -->
<section class="hero-section d-flex flex-column flex-lg-row align-items-center justify-content-center text-center text-lg-start"
  style="min-height: 85vh; background: #f9fafb;">
  <div class="hero-text col-lg-6 px-4 px-lg-5">
    <h1 class="display-4 fw-bold mb-4" style="line-height: 1.2;">
      Build your <span class="text-primary">Online Presence</span> with <br> Reliable & Fast Hosting
    </h1>
    <p class="lead text-secondary mb-4">
      Hosting solutions designed to scale with your business — secure, fast & easy.
    </p>
    <a href="#hosting-plans" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">Explore Hosting</a>
  </div>
  <div class="hero-image col-lg-6 px-4 px-lg-5 mt-5 mt-lg-0">
    <img src="{{ asset('images/hero-minimal.png') }}" alt="Hosting Illustration" class="img-fluid rounded shadow-lg" style="max-height: 400px;">
  </div>
</section>

<!-- Domain Search -->
<section id="domain-search" class="py-5 bg-white">
  <div class="container px-5">
    <div class="mx-auto" style="max-width: 600px;">
      <form action="{{ url('/domain/search') }}" method="GET" class="d-flex gap-2 flex-column flex-sm-row align-items-center">
        <div class="form-floating flex-grow-1 mb-3 mb-sm-0">
          <input 
            type="search" 
            name="query" 
            id="domainQuery" 
            class="form-control form-control-lg rounded-pill border-primary" 
            placeholder="Search domain names..." 
            autocomplete="off" 
            required
          >
          <label for="domainQuery" class="text-secondary">Find your perfect domain</label>
        </div>
        <button 
          type="submit" 
          class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm"
          style="white-space: nowrap;"
        >
          Search
        </button>
      </form>
      <p class="text-center text-muted mt-3 small">
        Popular: 
        <a href="javascript:void(0)" class="text-decoration-none">.com</a> |
        <a href="javascript:void(0)" class="text-decoration-none">.io</a> |
        <a href="javascript:void(0)" class="text-decoration-none">.tech</a>
      </p>
    </div>
  </div>
</section>

<!-- Hosting Plans Grid -->
<section id="hosting-plans" class="py-5 bg-light">
  <div class="container px-5">
    <h2 class="text-center fw-bold mb-5">Hosting Plans Tailored for You</h2>
    <div class="row g-4">
      @php
        $plans = [
          ['title' => 'Shared Hosting', 'price' => 8.99, 'features' => ['Unlimited Bandwidth', '99.9% Uptime', 'Free SSL Certificate']],
          ['title' => 'Cloud Hosting', 'price' => 29.99, 'features' => ['Auto Scaling', 'Daily Backups', 'SSH Access']],
          ['title' => 'Dedicated Server', 'price' => 79.99, 'features' => ['Full Root Access', 'Dedicated IP', '24/7 Support']],
        ];
      @endphp
      @foreach ($plans as $plan)
      <div class="col-md-4">
        <div class="plan-card p-4 bg-white rounded shadow-sm h-100 d-flex flex-column">
          <h3 class="mb-3 text-primary fw-semibold">{{ $plan['title'] }}</h3>
          <h4 class="fw-bold mb-3">${{ number_format($plan['price'], 2) }} <small class="text-muted fs-6">/month</small></h4>
          <ul class="list-unstyled flex-grow-1 mb-4">
            @foreach ($plan['features'] as $feature)
            <li class="mb-2 d-flex align-items-center text-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#0d6efd" class="me-2 bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.44 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.997 1.998z"/>
              </svg>
              {{ $feature }}
            </li>
            @endforeach
          </ul>
          <a href="{{ url('/hosting') }}" class="btn btn-outline-primary rounded-pill mt-auto align-self-start px-4">Choose Plan</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('styles')
<style>
  /* Smooth scroll for anchor links */
  html {
    scroll-behavior: smooth;
  }

  /* Hero Section */
  .hero-section {
    padding-top: 4rem;
    padding-bottom: 4rem;
  }

  /* Plan card hover effect */
  .plan-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .plan-card:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 24px rgba(13, 110, 253, 0.25);
  }

  /* Floating label input focus color override for better contrast */
  .form-floating > input:focus ~ label {
    color: #0d6efd !important;
  }

  /* Navbar link spacing */
  .navbar-nav .nav-link {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    transition: color 0.3s ease;
  }
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link:focus {
    color: #0d6efd;
  }
</style>
@endpush
