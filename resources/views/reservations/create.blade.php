<!-- edit.blade.php -->

@include('layouts.dashheader')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.sidebar') <!-- Include the sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

            @include('layouts.topbar') <!-- Include the topbar -->

            <!-- Main Content -->
            <div id="content">
                <!-- Your main content goes here -->
                <div class="container-fluid">
                    <!-- Reservation Edit Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Reservation</h5>
                            <a href="{{ route('reservationdash') }}" class="btn btn-secondary btn-sm float-right mr-2">Back</a>
                        </div>
                        <div class="card-body">
                            <!-- Reservation Edit Form -->
                            <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
                                @csrf
                                @method('PUT')
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $reservation->description }}</textarea>
                                </div>

                                <!-- Reservation Date -->
                                <div class="form-group">
                                    <label for="reservation_date">Reservation Date</label>
                                    <input type="text" class="form-control" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}" required>
                                </div>

                                <!-- Return Date -->
                                <div class="form-group">
                                    <label for="return_date">Return Date</label>
                                    <input type="text" class="form-control" id="return_date" name="return_date" value="{{ $reservation->return_date }}" required>
                                </div>

                                <!-- Is Returned -->
                                <div class="form-group">
                                    <label for="is_returned">Is Returned</label>
                                    <input type="checkbox" class="form-check-input" id="is_returned" name="is_returned" {{ $reservation->is_returned ? 'checked' : '' }}>
                                </div>

                                <!-- User ID (You may want to disable this field for editing) -->
                                <div class="form-group">
                                    <label for="user_id">User ID</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $reservation->user_id }}" disabled>
                                </div>

                                <!-- Book ID (You may want to disable this field for editing) -->
                                <div class="form-group">
                                    <label for="book_id">Book ID</label>
                                    <input type="text" class="form-control" id="book_id" name="book_id" value="{{ $reservation->book_id }}" disabled>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Reservation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
