<!-- Main Content -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('layouts.topbar') <!-- Include the topbar.blade.php file here -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
            </div>

            <!-- Your Custom Content Goes Here -->
            {{-- @yield('custom-content') <!-- This allows you to inject custom content from specific views --> --}}

            
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">Perform CRUD operations on users.</p>
                            <a href="{{ route('users.index') }}" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Books</h5>
                            <p class="card-text">Perform CRUD operations on books.</p>
                            <a href="{{ route('books.index') }}" class="btn btn-primary">Go to Books</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Reservations</h5>
                            <p class="card-text">Perform CRUD operations on reservations.</p>
                            <a href="{{ route('reservations.index') }}" class="btn btn-primary">Go to Reservations</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        
        </div>
        <!-- End Page Content -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Main Content -->
