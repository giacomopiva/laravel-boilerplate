@extends('layouts.app-front')

@section('content')

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
    <!-- Hero Section -->
    <div class="d-flex">
      <div class="container d-flex align-items-center vh-100">
        <div class="w-sm-75 w-lg-50 text-center mx-sm-auto">
          <div class="mb-7">
            <img class="img-fluid" src="{{ asset('images/svg/oc-maintenance.svg') }}">
          </div>

          <h1 class="h2">We're just tuning up a few things.</h1>
          <p>We apologize for the inconvenience but Front is currently undergoing planned maintenance. Stay tuned!</p>
        </div>
      </div>
    </div>
    <!-- End Hero Section -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

@endsection
