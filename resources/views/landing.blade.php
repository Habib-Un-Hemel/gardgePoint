@extends('layouts.app')

@section('styles')
<!-- Custom styles already in app.blade.php -->
<style>
   .banner_main {
      background: url('{{ asset('css/images/banner.jpg') }}') no-repeat center center;
      background-size: cover;
      height: 80vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
   }

   .banner_main::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0, 0, 0, 0.5); /* dark overlay for readability */
   }

   .banner_main .container {
      position: relative;
      z-index: 2;
   }

   .banner_main h1 {
      font-size: 3rem;
      font-weight: 700;
   }

   .banner_main p {
      font-size: 1.5rem;
   }

   h2 {
      font-size: 2.2rem;
      font-weight: 600;
   }

   h4 {
      font-size: 1.4rem;
      font-weight: 600;
   }

   p.lead {
      font-size: 1.2rem;
   }
</style>
@endsection

@section('content')

<!-- Hero Banner -->
<section class="banner_main">
   <div id="banner1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container text-center py-5">
               <h1 class="text-white">Premium Car Workshop</h1>
               <p class="lead text-white">Trusted maintenance and repair services by certified professionals.</p>
               <a href="{{ url('/book-appointment') }}" class="btn btn-primary btn-lg mt-3">Book Now</a>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Services Section -->
<section class="py-5">
   <div class="container">
      <h2 class="text-center mb-4">Our Services</h2>
      <div class="row">
         <div class="col-md-4 mb-4">
            <div class="border p-3 text-center h-100">
               <img src="{{ asset('css/images/image1.png') }}" class="img-fluid mb-3" alt="Diagnostics">
               <h4>Diagnostics</h4>
               <p>Quick, accurate issue detection with modern equipment.</p>
            </div>
         </div>
         <div class="col-md-4 mb-4">
            <div class="border p-3 text-center h-100">
               <img src="{{ asset('css/images/image2.png') }}" class="img-fluid mb-3" alt="Repair">
               <h4>Repair</h4>
               <p>Expert repairs for all major car brands by certified mechanics.</p>
            </div>
         </div>
         <div class="col-md-4 mb-4">
            <div class="border p-3 text-center h-100">
               <img src="{{ asset('css/images/image.png') }}" class="img-fluid mb-3" alt="Maintenance">
               <h4>Maintenance</h4>
               <p>Routine service plans to keep your vehicle running perfectly.</p>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- About Section -->
<section class="bg-light py-5">
   <div class="container">
      <h2 class="text-center mb-4">About Us</h2>
      <p class="text-center mx-auto" style="max-width: 700px; font-size: 1.2rem;">
         Since 2005, our car workshop has served with honesty, precision, and care. Our skilled team handles everything from oil changes to full repairs using genuine parts and advanced tools.
      </p>
      <div class="text-center mt-3">
         <a href="{{ url('/contact-admin') }}" class="btn btn-secondary btn-lg">Contact Us</a>
      </div>
   </div>
</section>

<!-- Owner Testimonial -->
<section class="py-5">
   <div class="container">
      <h2 class="text-center mb-4">Meet the Owner</h2>
      <div class="row justify-content-center">
         <div class="col-md-6 text-center">
            <img src="{{ asset('css/images/tes3.jpg') }}" alt="Owner" class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h4>Habib-Un-Nabi Hemel</h4>
            <p class="text-muted">Owner & Founder</p>
            <p style="font-size: 1.1rem;">"I started this workshop with a vision: to bring honesty, high-quality service, and customer satisfaction to every car we handle. Your trust drives our commitment to excellence."</p>
         </div>
      </div>
   </div>
</section>

@endsection

@section('scripts')
<!-- Scripts already in app.blade.php -->
@endsection
