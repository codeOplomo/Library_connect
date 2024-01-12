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
    <link rel="stylesheet" href="https://cdn.rawgit.com/PropellerDevelopment/propeller/develop/dist/css/propeller.min.css">
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">
    <!-- Google Material Icons CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap Date-Time Picker CSS -->
    <link rel="stylesheet" href="datetimepicker/css/bootstrap-datetimepicker.css">
    <!-- Propeller Date-Time Picker CSS -->
    <link rel="stylesheet" href="datetimepicker/css/pmd-datetimepicker.css">

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
        padding: 6px 8px; /* Adjust the padding as needed */
        font-size: 14px; /* Adjust the font size as needed */
    }

    /* Icon for the date-time picker */
    #returnDateIcon {
        width: 30px; /* Adjust the width of the icon */
        height: 30px; /* Adjust the height of the icon */
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

    <!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Reserved Books</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="reservedBooksList"></div>
                
                <!--Time picker -->
                <div class="form-group pmd-textfield pmd-textfield-floating-label" id="returnDateInput">
                    <label class="control-label" for="returnDate">Return Date</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="returnDate">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary" onclick="confirmReservation()">Confirm Reservation</button> --}}
                <button type="button" class="btn btn-primary" id="confirmReservationBtn">Confirm Reservation</button>

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
    function confirmReservation() {
    var reservedBooks = JSON.parse(sessionStorage.getItem('reservedBooks') || '[]');
    var returnDate = document.getElementById('returnDate').value;

    $.ajax({
        url: '{{ route("reservations.store") }}', // Assuming your route is named "reservations.store"
        type: 'POST',
        data: {
            reservedBooks: reservedBooks,
            returnDate: returnDate,
            _token: '{{ csrf_token() }}',
        },
        success: function (response) {
    console.log(response);
    if (response.status) {
        alert('Reservation successful');
        $('#cartModal').modal('hide');
    } else {
        alert('Reservation failed: ' + JSON.stringify(response));
    }
},


        error: function (error) {
            console.log(error);
            alert('Reservation failed. Please try again.');
        }
    });
}

$(document).ready(function () {
    $('#confirmReservationBtn').on('click', confirmReservation);
});
</script>
</body>

</html>
