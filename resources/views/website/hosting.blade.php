@extends('website.layouts.main')

@section('title', 'Hosting Plans')

@section('content')
<!-- Order Section -->
<div class="order">
   <div class="container">
      <div class="row">
         <div class="col-md-8 offset-md-2">
            <div class="titlepage text_align_center">
               <h2>Check Out Awesome Plans, <br> <span class="blue_light">Order Now</span></h2>
               <p>Dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
         </div>
      </div>
      <div class="row">
         @php
            $plans = [
               ['name' => 'Shared Hosting', 'price' => 9],
               ['name' => 'Reseller Hosting', 'price' => 9],
               ['name' => 'Dedicated Servers', 'price' => 9],
            ];
         @endphp

         @foreach ($plans as $plan)
         <div class="col-md-4">
            <div class="order-box_main" id="ho_co">
               <div class="order-box text_align_center">
                  <h3>{{ $plan['name'] }}</h3>
                  <p>STARTING <span>${{ $plan['price'] }}</span> PER MONTH</p>
                  <a href="javascript:void(0)">Personal use</a>
                  <ul class="supp">
                     <li>Unlimited projects</li>
                     <li>24/7 support</li>
                     <li>Personal use</li>
                     <li>Unlimited projects</li>
                     <li>24/7 support</li>
                  </ul>
               </div>
               <a class="read_more" href="javascript:void(0)">Buy Now</a>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
<!-- End Order Section -->
@endsection
