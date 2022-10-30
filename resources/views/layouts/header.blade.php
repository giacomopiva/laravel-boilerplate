  <!-- ========== HEADER ========== -->
  <header id="header" class="navbar navbar-expand navbar-light navbar-absolute-top">
    <div class="container">
      <nav class="navbar-nav-wrap">
        <!-- Default Logo -->
        <a class="navbar-brand" href="{{ route('home') }}" aria-label="Front">
          <img class="navbar-brand-logo" src="{{ asset('images/svg/logo.svg') }}" alt="Logo">
        </a>
        <!-- End Default Logo -->

        @if(!App::isDownForMaintenance())
        <div class="ms-auto">
          <a class="btn btn-primary btn-transition" href="{{ route('login') }}" target="_blank">Login</a>
        </div>
        @endif
        
      </nav>
    </div>
  </header>
  <!-- ========== END HEADER ========== -->
