@extends('layouts.app-front')

@section('content')

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
    <!-- Content -->
    <div class="d-md-flex">
      <div class="container d-md-flex align-items-md-center vh-md-100 content-space-t-3 content-space-b-1 content-space-b-md-3 content-space-md-0">
        <div class="row justify-content-md-between align-items-md-center flex-grow-1">
          <div class="col-9 col-md-5 mb-5 mb-md-0">
            <img class="img-fluid" src="{{ asset('images/svg/oc-yelling.svg') }}" alt="SVG Illustration">
          </div>
          <!-- End Col -->

          <div class="col-md-6">
            <!-- Heading -->
            <div class="mb-4">
              <h1>We're coming soon.</h1>
              <p>Our website is under construction. We'll be here soon with our new awesome site, subscribe to be notified.</p>
            </div>
            <!-- End Heading -->

            <div class="js-countdown row mb-5">
              <div class="col-3">
                <h2 class="js-cd-days h1 text-primary mb-0"></h2>
                <h5 class="mb-0">Days</h5>
              </div>
              <!-- End Col -->

              <div class="col-3">
                <h2 class="js-cd-hours h1 text-primary mb-0"></h2>
                <h5 class="mb-0">Hours</h5>
              </div>
              <!-- End Col -->

              <div class="col-3">
                <h2 class="js-cd-minutes h1 text-primary mb-0"></h2>
                <h5 class="mb-0">Mins</h5>
              </div>
              <!-- End Col -->

              <div class="col-3">
                <h2 class="js-cd-seconds h1 text-primary mb-0"></h2>
                <h5 class="mb-0">Secs</h5>
              </div>
              <!-- End Col -->
            </div>
            <!-- End Row -->
          </div>
          <!-- End Col -->
        </div>
        <!-- End Row -->
      </div>
    </div>
    <!-- End Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- JS Implementing Plugins -->
  <script src="{{ asset('front/vendor/countdown/countdown.js') }}"></script>

  <script>
    (function () {
      // INITIALIZATION OF COUNTDOWN
      // =======================================================
      const oneYearFromNow = new Date()

      document.querySelectorAll('.js-countdown').forEach(item => {
        const days = item.querySelector('.js-cd-days'),
          hours = item.querySelector('.js-cd-hours'),
          minutes = item.querySelector('.js-cd-minutes'),
          seconds = item.querySelector('.js-cd-seconds')

        countdown(oneYearFromNow.setFullYear(
          oneYearFromNow.getFullYear() + 1),
          ts => {
            days.innerHTML = ts.days
            hours.innerHTML = ts.hours
            minutes.innerHTML = ts.minutes
            seconds.innerHTML = ts.seconds
          },
          countdown.DAYS | countdown.HOURS | countdown.MINUTES | countdown.SECONDS
        )
      })
    })()
  </script>

@endsection
