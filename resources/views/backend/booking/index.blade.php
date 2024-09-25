@extends('backend.includes.main')

<!DOCTYPE html>
<html lang="en">

<body>
    @section('content')
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Bookings</h3>
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
                            <a href="{{ route('booking.index') }}">Bookings</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('booking.index') }}">Manage Bookings</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Manage Bookings</h4>
                                <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm float-end">
                                    Add New Booking
                                </a>
                            </div>

                            <div class="card-body">
                                <!-- Success Message -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                        <meta http-equiv="refresh" content="5;url={{ route('booking.index') }}">
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="multi-filter-select" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Room</th>
                                                <th>Guest</th>
                                                <th>Check-in Date</th>
                                                <th>Check-out Date</th>
                                                <th>Guests</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->room->name }}</td>
                                                    <td>{{ $booking->user->name }}</td>
                                                    <td>{{ Carbon\Carbon::parse($booking->check_in_date)->format('Y-m-d') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($booking->check_out_date)->format('Y-m-d') }}</td>
                                                    <td>{{ $booking->guests_count }}</td>
                                                    <td>${{ number_format($booking->total_price, 2) }}</td>
                                                    <td>
                                                        <form action="{{ route('booking.updateStatus', $booking->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status" onchange="this.form.submit()"
                                                                class="form-select form-select-sm">
                                                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('booking.delete', $booking->id) }}" method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Room</th>
                                                <th>Guest</th>
                                                <th>Check-in Date</th>
                                                <th>Check-out Date</th>
                                                <th>Guests</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
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
            $('#booking-table').DataTable();
        });
    </script>
</body>

</html>
