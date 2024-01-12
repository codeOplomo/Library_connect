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
                    <!-- Book Edit Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Book</h5>
                            <a href="{{ route('dashbook') }}" class="btn btn-secondary btn-sm float-right mr-2">Back</a>

                        </div>
                        <div class="card-body">
                            <!-- Book Edit Form -->
                            <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                                </div>

                                <!-- Author -->
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
                                </div>

                                <!-- Type -->
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" name="type" value="{{ $book->type }}" required>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $book->description }}</textarea>
                                </div>

                                <!-- Image Upload -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>

                                <!-- Publication Year -->
                                <div class="form-group">
                                    <label for="publication_year">Publication Year</label>
                                    <input type="text" class="form-control" id="publication_year" name="publication_year" value="{{ $book->publication_year }}" required>
                                </div>

                                <!-- Available Copies -->
                                <div class="form-group">
                                    <label for="available_copies">Available Copies</label>
                                    <input type="number" class="form-control" id="available_copies" name="available_copies" value="{{ $book->available_copies }}" required>
                                </div>

                                <!-- Total Copies -->
                                <div class="form-group">
                                    <label for="total_copies">Total Copies</label>
                                    <input type="number" class="form-control" id="total_copies" name="total_copies" value="{{ $book->total_copies }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
