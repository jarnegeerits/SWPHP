@extends('master')

@section('title', 'Home')

@section('content')

<a class="menu-toggle rounded" href="#">
    <i class="fas fa-bars"></i>
</a>

<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a class="js-scroll-trigger" href="#page-top">SocialWheels</a>
        </li>
        <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#page-top">Home</a>
        </li>
        <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="/home">Dashboard</a>
        </li>
        <li class="sidebar-nav-item">
            <a class="js-scroll-trigger" href="#contact">Contact</a>
        </li>
    </ul>
</nav>

<!-- Header -->
<header class="masthead d-flex">
    <div class="container text-center my-auto">
        <h1 class="mb-1 masttext">{{ config('app.name') }}</h1>
        <h3 class="mb-5 masttext">
            <em>Sharing is caring</em>
        </h3>
        <a class="btn btn-danger btn-xl js-scroll-trigger" href="/login">Get started</a>
    </div>
    <div class="overlay"></div>
</header>

  {{-- <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
          <p class="lead mb-5">This theme features a flexible, UX friendly sidebar menu and stock photos from our friends at
            <a href="https://unsplash.com/">Unsplash</a>!</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="#services">What We Offer</a>
        </div>
      </div>
    </div>
  </section> --}}

<!-- Services -->
<section class="content-section bg-primary text-white text-center" id="services">
    <div class="container">
        <div class="content-section-heading">
            <h2 class="mb-5">What We Offer</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3">
                    <i class="icon-screen-smartphone"></i>
                </span>
                <h4>
                    <strong>On the go</strong>
                </h4>
                <p class="text-faded mb-0">Works everywhere, on everything</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                <span class="service-icon rounded-circle mx-auto mb-3">
                    <i class="icon-pencil"></i>
                </span>
                <h4>
                    <strong>Simplistic</strong>
                </h4>
                <p class="text-faded mb-0">Functional and easy to use</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                <span class="service-icon rounded-circle mx-auto mb-3">
                    <i class="icon-like"></i>
                </span>
                <h4>
                    <strong>Feedback</strong>
                </h4>
                <p class="text-faded mb-0">Show eachother some appreciation</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <span class="service-icon rounded-circle mx-auto mb-3">
                    <i class="icon-mustache"></i>
                </span>
                <h4>
                    <strong>Maintained</strong>
                </h4>
                <p class="text-faded mb-0">Like a proper moustache</p>
            </div>
        </div>
    </div>
</section>

<!-- Callout -->
<section class="callout">
    <div class="container text-center">
        <h2 class="mx-auto mb-5 masttext">Welcome to
            the future of motoring</h2>
        <a class="btn btn-danger btn-xl" href="/login">Lets go!</a>
    </div>
</section>

<!-- Call to Action -->
@unless(Auth::check())
    <section class="content-section bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Let's get started</h2>
            <a href="/register" class="btn btn-xl btn-light mr-4">Register</a>
            <a href="/login" class="btn btn-xl btn-dark">Log in</a>
        </div>
    </section>
@endunless

<!-- Map -->
<section id="contact" class="map">
    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2511.054714696656!2d5.533176416013085!3d50.99666105573722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0d8d1f956f48f%3A0x6640c0b876d409f2!2sSYNTRA%20Limburg%20campus%20Genk!5e0!3m2!1snl!2sbe!4v1589830638186!5m2!1snl!2sbe"></iframe>
    <br />
    <small>
        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2511.054714696656!2d5.533176416013085!3d50.99666105573722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c0d8d1f956f48f%3A0x6640c0b876d409f2!2sSYNTRA%20Limburg%20campus%20Genk!5e0!3m2!1snl!2sbe!4v1589830638186!5m2!1snl!2sbe"></a>
    </small>
</section>

<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
        <ul class="list-inline mb-5">
            <li class="list-inline-item">
                <a class="social-link rounded-circle text-white mr-3" href="#">
                    <i class="icon-social-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="social-link rounded-circle text-white mr-3" href="#">
                    <i class="icon-social-twitter"></i>
            </a>
            </li>
            <li class="list-inline-item">
                <a class="social-link rounded-circle text-white" href="#">
                    <i class="icon-social-github"></i>
                </a>
            </li>
        </ul>
        <p class="text-muted small mb-0">Copyright &copy; {{ config('app.name') }} {{ now()->year }}</p>
    </div>
</footer>

@endsection
