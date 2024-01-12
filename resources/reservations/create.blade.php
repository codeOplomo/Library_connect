<!-- create.blade.php -->

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
                    <!-- User Create Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Reservation</h5>
                            <a href="{{ route('dashreservation') }}" class="btn btn-secondary btn-sm float-right mr-2">Back</a>

                        </div>
                        <div class="card-body">
                            <!-- User Create Form -->
                            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Username -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>

                                <!-- Role -->
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
                                        <!-- Populate this dropdown with roles from your database -->
                                        <!-- Example: <option value="1">Admin</option> -->
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
