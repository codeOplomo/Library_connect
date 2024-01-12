<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SmartLibra</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styleshome.css') }}" rel="stylesheet" />
    <style>
        #portfolio .portfolio-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body id="page-top">

    @include('layouts.userheader')
    
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold">SmartLibra</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5">Explore, customize, and embark on a journey to create a digital haven for literature lovers!</p>
                    <a class="btn btn-primary btn-xl" href="#about" style="background-color: #C66D28;">Find Out More</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About -->
<section class="page-section" id="about" style="background-color: #C66D28;">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">We've got what you need!</h2>
                <hr class="divider divider-light" />
                <p class="text-white-75 mb-4">
                    Dive into our curated collection of literary treasures—bestsellers, classics, and hidden gems await. Ready to embark on your next reading adventure? Reserve or buy your favorite book today and let the pages transport you to new worlds!
                </p>
                <a class="btn btn-light btn-xl" href="{{ route('register') }}">Get Started!</a>

            </div>
        </div>
    </div>
</section>

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">At Your Service</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <!-- ... (services section content) ... -->
            </div>
        </div>
    </section>

    <!-- Portfolio-->
    <div id="portfolio">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <!-- ... (portfolio items) ... -->
            </div>
        </div>
    </div>
    <!-- Call to action-->
    <section class="page-section bg-dark text-white">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">60% OFF!</h2>
            <a class="btn btn-light btn-xl" href="https://startbootstrap.com/theme/creative/">Shop Now!</a>
        </div>
    </section>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Let's Get In Touch!</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5">Ready to embark on your next literary project with us? If you're an author with a manuscript ready for publishing, we invite you to reach out to us! Send us a message, and we'll promptly get back to you to discuss the exciting possibility of showcasing and selling your book on our platform!</p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- ... (contact form inputs) ... -->
                        <div class="d-grid" style="background-color: #C66D28; border-radius: 15px;"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-4 text-center mb-5 mb-lg-0">
                    <i class="bi-phone fs-2 mb-3 text-muted"></i>
                    <div>+212 (0) 71449-1697</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    @include('layouts.footer')
</body>
</html>