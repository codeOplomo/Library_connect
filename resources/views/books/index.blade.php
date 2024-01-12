<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLibra - Books</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .book-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        body {
            padding-top: 56px;
            /* Adjust this value based on your navbar's height */
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SmartLibra</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#cartModal">
                        <i class="bi-cart-fill mr-1"></i>
                        Cart
                        <span class="badge badge-dark text-white ml-1" id="cartCount">
                            {{-- Retrieve existing reserved books from session storage --}}
                            @php
                                $reservedBooks = json_decode(session('reservedBooks', '[]'), true);
                                // Output the count of reserved books or 0 if not set
                                echo count($reservedBooks);
                            @endphp
                        </span>
                    </button>
                </form>
                <!-- ... (rest of your modal code) ... -->
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Library Book Catalog</h1>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 book-card">
                        <img class="card-img-top" src="{{ $book['image_link'] }}" alt="{{ $book['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book['title'] }}</h5>
                            <p class="card-text">{{ $book['description'] }}</p>
                            <p>Author: {{ $book['author'] }}</p>
                            <p>Genre: {{ $book['genre'] }}</p>
                            <p>Publication Year: {{ $book->publication_year }}</p>
                            @if ($book['available_copies'] > 1)
                            <p>Available Copies: {{ $book->available_copies }}</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            @if ($book['available_copies'] < 1)
                                <button type="hidden" class="btn btn-primary disabled">Reserve it</button>
                            @else
                                <button onclick="reserveBook({{ json_encode($book) }})" class="btn btn-primary">Reserve
                                    it</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Bootstrap and Bootstrap Datepicker JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Your custom script -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
