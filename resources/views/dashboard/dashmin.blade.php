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
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">Perform CRUD operations on users.</p>
                            <a href="{{ route('dashuser') }}" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>
                

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Books</h5>
                            <p class="card-text">Perform CRUD operations on books.</p>
                            <a href="{{ route('dashbook') }}" class="btn btn-primary">Go to Books</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Reservations</h5>
                            <p class="card-text">Perform CRUD operations on reservations.</p>
                            <a href="{{ route('dashreservation') }}" class="btn btn-primary">Go to Reservations</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
            </div>

        </div>
    </div>
</body>

</html>
