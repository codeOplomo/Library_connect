<!-- dashbook.blade.php -->

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
                    <!-- Reservation Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Reservation Management</h5>
                            <a href="{{ route('reservations.create') }}" class="btn btn-success btn-sm float-right">Add Reservation</a>
                            <a href="{{ route('dash.back') }}" class="btn btn-secondary btn-sm float-right mr-2">Back</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Reservation Date</th>
                                        <th>Return Date</th>
                                        <th>User</th>
                                        <th>Book</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Reservation Data -->
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->id }}</td>
                                            <td>{{ $reservation->description }}</td>
                                            <td>{{ $reservation->reservation_date }}</td>
                                            <td>{{ $reservation->return_date }}</td>
                                            <td>{{ $reservation->user->username }}</td>
                                            <td>{{ $reservation->book->title }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('reservations.edit', $reservation->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('reservations.destroy', $reservation->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
