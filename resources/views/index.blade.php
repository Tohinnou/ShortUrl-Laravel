@extends('base')

@section('content')
<main>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/carousel/carousel1.jpg')}}" alt="carousel1">
  
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Best Short Url</h1>
              <p>URL shortener allows to create a shortened link making it easy to share</p>
              <p><a class="btn btn-lg btn-primary" href="{{ route('register')}}">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carousel/carousel2.jpg')}}" alt="carousel2">
  
          <div class="container">
            <div class="carousel-caption">
              <h1>Paste the URL to be shortened Enter the link here</h1>
              <p>ShortURL is a free tool to shorten URLs and generate short links</p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('img/carousel/carousel.jpg')}}" alt="carousel3">
  
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>Simple and fast URL shortener!.</h1>
              <p>Your shortened URLs can be used in publications, documents, 
                advertisements, blogs, forums, instant messages, and other locations.
              </p>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
  
    <div class="container marketing">
  
      <!-- Three columns of text below the carousel -->
      <div class="row">

        <div class="col-lg-4">
            <img src="{{ asset('img/icon-like.png')}}" alt="Easy">
          <h2 class="fw-normal">Easy</h2>
          <p>ShortURL is easy and fast, enter the long link to get your shortened link</p>
        </div>

        <div class="col-lg-4">
            <img src="{{ asset('img/icon-url.png')}}" alt="shortened">
          <h2 class="fw-normal">Shortened</h2>
          <p>Use any link, no matter what size, ShortURL always shortens</p>
        </div>

        <div class="col-lg-4">
            <img src="{{ asset('img/icon-secure.png')}}" alt="secure">
          <h2 class="fw-normal">Secure</h2>
          <p>  It is fast and secure, our service has HTTPS protocol and data encryption</p>
        </div>

    </div>

    {{-- Marketing row 2 --}}
  
    <div class="container marketing">
  
        <!-- Three columns of text below the carousel -->
        <div class="row">

          <div class="col-lg-4">
            <img src="{{ asset('img/icon-statistics.png')}}" alt="Statistics">
            <h2 class="fw-normal">Statistics</h2>
            <p>Check the number of clicks that your shortened URL received</p>
          </div>

          <div class="col-lg-4">
            <img src="{{ asset('img/icon-unique.png')}}" alt="Reliable">
            <h2 class="fw-normal">Reliable</h2>
            <p> All links that try to disseminate spam, viruses and malware are deleted</p>
          </div>

          <div class="col-lg-4">
            <img src="{{ asset('img/icon-responsive.png')}}" alt="Devices">
            <h2 class="fw-normal">Devices</h2>
            <p> Compatible with smartphones, tablets and desktop</p>
          </div>

    </div>
    
    <section class="col mx-auto mb-5 bg-white shadow-sm">
        <div class="card px-6" id="shortenCard">
            <div class="card-body">
                <div class="card-title text-center my-3 fw-700">
                    <h2>Paste the URL to be shortened</h2>
                </div>
                <form action="{{ route('ajax.shorten') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control form-control-lg " name="url" id="url" placeholder="Enter the link here" autocomplete="off">
                        <button type="submit" class="btn btn-primary" id="btnShortenUrl">Shorten URL</button>
                    </div>
                </form>
                <div class="footer mt-3 text-center">
                    <p class="fw-500 fs-5">ShortURL is a free tool to shorten URLs and generate short links</p>
                    <p class="fw-500 fs-5">URL shortener allows to create a shortened link making it easy to share</p>
                </div>
            </div>
        </div>
    </section>
  
    </div><!-- /.container -->
  
  
    <!-- FOOTER -->
    <footer class="container">
      <p class="float-end"><a href="#">Back to top</a></p>
      <p>&copy; 2023 Dunkerque@dev.</p>
    </footer>
  </main>
@endsection