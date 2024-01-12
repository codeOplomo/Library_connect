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
                    <!-- Book Table -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Book Management</h5>
                            <a href="{{ route('books.create') }}" class="btn btn-success btn-sm float-right">Add Book</a>
                            <a href="{{ route('dash.back') }}" class="btn btn-secondary btn-sm float-right mr-2">Back</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Genre</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Sample Book Data -->
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->genre }}</td>
                                            <td>
                                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
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
