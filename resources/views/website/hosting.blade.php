@extends('website.layouts.main')

@section('title', 'Hosting Plans')

@section('content')

<!-- Hosting Plans Section -->
<section id="hosting-plans" class="py-5 bg-light">
   <div class="container px-5">
      <div class="text-center mb-5">
         <h2 class="fw-bold mb-3">
            Check Out Awesome Plans <br>
            <span class="text-primary">Order Now</span>
         </h2>
         <p class="text-secondary">
            Choose the perfect plan for your personal or business needs. Reliable hosting, 24/7 support, and top-notch performance.
         </p>
      </div>

      <div class="row g-4">
         @php
            $plans = [
               ['name' => 'Shared Hosting', 'price' => 9, 'features' => ['Unlimited Projects', '24/7 Support', 'Free SSL']],
               ['name' => 'Reseller Hosting', 'price' => 19, 'features' => ['WHM Control Panel', 'White Label', '24/7 Priority Support']],
               ['name' => 'Dedicated Servers', 'price' => 79, 'features' => ['Full Root Access', 'High Performance', 'DDoS Protection']],
            ];
         @endphp

         @foreach ($plans as $plan)
         <div class="col-md-4">
            <div class="plan-card p-4 bg-white rounded shadow-sm h-100 d-flex flex-column text-center">
               <h3 class="mb-3 text-primary fw-semibold">{{ $plan['name'] }}</h3>
               <h4 class="fw-bold mb-3">${{ number_format($plan['price'], 2) }} <small class="text-muted fs-6">/month</small></h4>
               <ul class="list-unstyled flex-grow-1 mb-4 text-start">
                  @foreach ($plan['features'] as $feature)
                  <li class="mb-2 d-flex align-items-center text-secondary">
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#0d6efd" class="me-2 bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.44 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.997 1.998z"/>
                     </svg>
                     {{ $feature }}
                  </li>
                  @endforeach
               </ul>
               <a href="javascript:void(0)" class="btn btn-primary rounded-pill px-4 shadow-sm mt-auto">Buy Now</a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>
<!-- End Hosting Plans Section -->

@endsection

@push('styles')
<style>
   /* Reuse styles from Home for consistency */
   .plan-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
   }

   .plan-card:hover {
      transform: scale(1.05);
      box-shadow: 0 12px 24px rgba(13, 110, 253, 0.25);
   }

   html {
      scroll-behavior: smooth;
   }
</style>
@endpush
