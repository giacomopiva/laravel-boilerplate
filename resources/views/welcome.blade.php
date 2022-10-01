@extends('layouts.app-front')

@section('content')

<main id="content" role="main">
    <!-- Hero -->
    <div class="container overflow-hidden content-space-t-4">
        <div class="w-lg-75 text-center mx-lg-auto mb-9">
            <h1 class="display-3 mb-4">Build as frameworks from the ground up</h1>
            <p class="lead">Bring your idea to life in no time. The website solution for all your needs. For UX designers, entrepreneurs, product managers, marketers, and anyone.</p>
        </div>
    </div>
    <!-- End Hero -->
    
    <!-- Hero Image -->
    <div class="container-fluid content-space-b-2 content-space-b-lg-4">
        <div class="d-md-none">
            <img class="img-fluid" src="./assets/img/mockups/img3.png" alt="Image Description">
        </div>
        
        <div class="d-none d-md-block">
            <img class="img-fluid" src="https://via.placeholder.com/1660x500.jpg" alt="Image Description">
        </div>
    </div>
    <!-- End Hero Image -->

    <!-- Documentation -->
    <div class="content-space-t-2 content-space-b-lg-4">
        <div class="container">
            <div class="bg-light p-4 p-sm-10">
                <!-- Heading -->
                <div class="w-md-75 text-center mx-md-auto mb-5 mb-md-9">
                    <h2>Documentation</h2>
                    <p class="fs-4">Get started with Front - Multipurpose Responsive Template for building responsive, mobile-first sites, with Bootstrap and a template starter page.</p>
                    <a href="#" class="btn btn-primary">Browse Documentation</a>
                </div>
                <!-- End Heading -->
            </div>
        </div>
    </div>
    <!-- End Documentation -->
</main>

@endsection
