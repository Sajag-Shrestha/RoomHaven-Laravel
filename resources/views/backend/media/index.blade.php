@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">

<body>
    @section('content')
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Media</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('media.index') }}">Media</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('media.index') }}">Manage Media</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Media</h4>
                                <a href="{{ route('media.create') }}" class="btn btn-primary btn-sm float-end">
                                    Add New Media
                                </a>
                            </div>

                            <div class="card-body">
                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                        <meta http-equiv="refresh" content="5;url={{ route('media.index') }}">
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="multi-filter-select" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Upload Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($media as $item)
                                                <tr>
                                                    <td>
                                                        @if (file_exists(public_path('uploads/' . $item->img_link)))
                                                            <a href="{{ asset('uploads/' . $item->img_link) }}"
                                                                data-fancybox="gallery" data-caption="{{ $item->title }}">
                                                                <img src="{{ asset('uploads/' . $item->img_link) }}"
                                                                    alt="{{ $item->title }}" width="100">
                                                            </a>
                                                        @else
                                                            <span>No Image Available</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>{{ $item->created_at->format('Y-m-d g:i A') }}</td>
                                                    <td>
                                                        <form action="{{ route('media.delete', $item->id) }}"
                                                            method="POST" style="display:inline-block;""
                                                            onsubmit="return confirm('Are you sure you want to delete this media?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>
                                                <th>File Name</th>
                                                <th>Upload Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#media-table').DataTable();
        });
    </script>
</body>

</html>
