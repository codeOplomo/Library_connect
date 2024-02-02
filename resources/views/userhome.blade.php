<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>SmartLibra - Books</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Propeller CSS -->
    <link rel="stylesheet"
        href="https://cdn.rawgit.com/PropellerDevelopment/propeller/develop/dist/css/propeller.min.css">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">
    <!-- Google Material Icons CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap Date-Time Picker CSS -->
    <link rel="stylesheet" href="datetimepicker/css/bootstrap-datetimepicker.css">
    <!-- Propeller Date-Time Picker CSS -->
    <link rel="stylesheet" href="datetimepicker/css/pmd-datetimepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .book-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        body {
            padding-top: 56px;
            /* Adjust this value based on your navbar's height */
        }

        /* Custom styles for the date-time picker */
        #returnDateInput {
            max-width: 350px;
            display: inline-block;
            border-radius: 4px;
            padding: 6px 8px;
            font-size: 14px;
        }

        /* Icon for the date-time picker */
        #returnDateIcon {
            width: 30px;
            height: 30px;
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
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
                
                <!-- Cart Button -->
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
                
                <!-- Logout Link -->
                @if(auth()->check())
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


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


        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>


    <!-- Footer -->
    @include('layouts.footer')

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Reserved Books</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="reservedBooksList">
                        <!-- The reserved books will be dynamically added here -->
                    </div>

                    <!-- Time picker -->
                    <div class="form-group pmd-textfield pmd-textfield-floating-label" id="returnDateInput">
                        <label class="control-label" for="return_date">Return Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="return_date">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="material-icons">date_range</i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" onclick="confirmReservation()">Confirm Reservation</button> --}}
                    {{-- <button type="button" class="btn btn-primary" id="makeReservation">Confirm Reservation</button> --}}
                    <button type="button" class="btn btn-primary" id="confirmReservationButton">Confirm
                        Reservation</button>


                </div>
            </div>
        </div>
    </div>



    <!-- jquery JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Propeller textfield JS -->
    <script src="dist/js/propeller.min.js"></script>
    <!-- Datepicker moment with locales -->
    <script src="datetimepicker/js/moment-with-locales.js"></script>
    <!-- Propeller Bootstrap datetimepicker -->
    <script src="datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <!-- Bootstrap and Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Your custom script -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            swal("Success!", "{{ session('success') }}", "success");
        @endif

        @if(session('error'))
            swal("Error!", "{{ session('error') }}", "error");
        @endif
    });
    </script>

</body>

</html>
