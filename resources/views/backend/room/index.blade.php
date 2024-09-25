@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">

<body>
    @section('content')
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Rooms</h3>
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
                            <a href="{{ route('rooms.index') }}">Rooms</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rooms.index') }}">Manage Rooms</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Rooms</h4>
                                @if (Auth::user()->role === 'Admin')
                                    <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-sm float-end">
                                        Add New Room
                                    </a>
                                @endif
                            </div>

                            <div class="card-body">
                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                        <meta http-equiv="refresh" content="5;url={{ route('rooms.index') }}">
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="multi-filter-select" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Room Name</th>
                                                <th>Description</th>
                                                <th>Rating</th>
                                                <th>Capacity</th>
                                                <th>Room Size (m<sup>2</sup>)</th>
                                                <th>Price per Night</th>
                                                <th>Upload Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($room as $item)
                                                <!-- Ensure this is correctly fetching room data -->
                                                <tr>
                                                    <td>
                                                        @if ($item->media)
                                                            <a href="{{ asset('uploads/' . $item->media->img_link) }}"
                                                                data-fancybox="gallery" data-caption="{{ $item->name }}">
                                                                <img src="{{ asset('uploads/' . $item->media->img_link) }}"
                                                                    alt="{{ $item->name }}" style="width: 100px;">
                                                            </a>
                                                        @else
                                                            No image available
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <!-- Ensure these field names match your database structure -->
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->rating }}</td>
                                                    <td>{{ $item->capacity }}</td>
                                                    <td>{{ $item->room_size }}</td>
                                                    <td>{{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->created_at->format('Y-m-d g:i A') }}</td>
                                                    <td>
                                                        <div
                                                            style="display: grid; grid-template-columns: auto; align-items: center; gap: 10px; width: fit-content;">
                                                            <!-- Edit Button -->
                                                            <a href="{{ route('rooms.edit', $item->id) }}"
                                                                class="btn btn-primary btn-sm"
                                                                style="width: 100px; text-align: center;">Edit</a>

                                                            <!-- Status Update Form -->
                                                            <form action="{{ route('rooms.updateStatus', $item->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                <div style="position: relative;">
                                                                    <select name="status" onchange="this.form.submit()"
                                                                        class="form-select btn-warning btn-sm"
                                                                        style="width: 100px;">
                                                                        <option value="available"
                                                                            {{ $item->status === 'available' ? 'selected' : '' }}>
                                                                            Available</option>
                                                                        <option value="booked"
                                                                            {{ $item->status === 'booked' ? 'selected' : '' }}>
                                                                            Booked</option>
                                                                        <option value="maintenance"
                                                                            {{ $item->status === 'maintenance' ? 'selected' : '' }}>
                                                                            Maintenance</option>
                                                                    </select>
                                                                    <span
                                                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); pointer-events: none;">&#9662;</span>
                                                                    <!-- caret -->
                                                                </div>
                                                            </form>

                                                            @if (Auth::user()->role === 'Admin')
                                                                <!-- Delete Button -->
                                                                <form action="{{ route('rooms.delete', $item->id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this room?');"
                                                                    style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        style="width: 100px; text-align: center;">Delete</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>
                                                <th>Room Name</th>
                                                <th>Description</th>
                                                <th>Rating</th>
                                                <th>Capacity</th>
                                                <th>Room Size (m<sup>2</sup>)</th>
                                                <th>Price per Night</th>
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
            $('#multi-filter-select').DataTable(); // Ensure the correct table ID is used
        });
    </script>
</body>

</html>
