    @extends('backend.includes.main')

    <!DOCTYPE html>
    <html lang="en">

    <body>
        @section('content')
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            @if (Auth::user()->role === 'Manager')
                            <h6 class="op-7 mb-2">RoomHeaven's Manager Dashboard</h6>
                            @endif
                            @if (Auth::user()->role === 'Admin')
                            <h6 class="op-7 mb-2">RoomHeaven's Admin Dashboard</h6>
                            @endif
                        </div>
                        @if (Auth::user()->role === 'Admin')
                            <div class="ms-md-auto py-2 py-md-0">
                                <a href="{{ route('users.index') }}" class="btn btn-label-info btn-round me-2">Manage</a>
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-round">Add User</a>
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->role === 'Manager' || Auth::user()->role === 'Admin')
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Users</p>
                                                    <h4 class="card-title">{{ $userCount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                                    <i class="fas fa-house"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Rooms</p>
                                                    <h4 class="card-title">{{ $roomCount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Revenue</p>
                                                    <h4 class="card-title">$ {{ round($totalPriceConfirmedBookings) }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Order</p>
                                                    <h4 class="card-title">{{ $bookingCount }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row d-flex justify-content-center">
                                            <div class="card-title">Latest Pending Bookings</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Room</th>
                                                    <th>Check-In</th>
                                                    <th>Check-Out</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($latestPendingBookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->room->name }}</td>
                                                        <td>{{ $booking->check_in_date }}</td>
                                                        <td>{{ $booking->check_out_date }}</td>
                                                        <td>{{ $booking->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row d-flex justify-content-center">
                                            <div class="card-title">Recently Added Rooms</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Room Name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentRooms as $room)
                                                    <tr>
                                                        <td>{{ $room->name }}</td>
                                                        <td>$ {{ round($room->price) }}</td>
                                                        <td>{{ $room->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role === 'Admin')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-round">
                                    <div class="card-body">
                                        <div class="card-head-row card-tools-still-right d-flex justify-content-center">
                                            <div class="card-title">New Users</div>
                                        </div>
                                        <div class="card-list py-4">
                                            @foreach ($newUsers as $users)
                                                <div class="item-list">
                                                    <div class="avatar">
                                                        <img src="{{ asset($users->profile_image) }}"
                                                            alt="{{ $users->role }}"
                                                            class="avatar-img rounded-circle img-thumbnail" />
                                                    </div>

                                                    <div class="info-user ms-3">
                                                        <div class="username">{{ $users->name }}</div>
                                                        <div class="status">{{ $users->email }}</div>
                                                    </div>

                                                    <div class="op-8 pe-3">
                                                        {{ $users->role }}
                                                    </div>

                                                    <a href="{{ route('users.edit', $users->id) }}" aria-label="Edit User">
                                                        <i class="fas fa-pen text-primary"></i>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row d-flex justify-content-center">
                                            <div class="card-title">Booking Purchase History</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-responsive table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Room Name</th>
                                                    <th>Room Image</th>
                                                    <th>Total Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentConfirmedBookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->user->name }}</td>
                                                        <td>{{ $booking->room->name }}</td>
                                                        <td>
                                                            @if ($booking->room->media)
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('uploads/' . $booking->room->media->img_link) }}"
                                                                    alt="{{ $booking->room->name }}"
                                                                    style="width: 200px; height: auto;">
                                                            @else
                                                                <span>No Image</span>
                                                            @endif
                                                        </td>
                                                        <td>${{ number_format($booking->total_price, 0) }}</td>
                                                        <td>{{ $booking->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role === 'Manager')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-round">
                                    <div class="card-header">
                                        <div class="card-head-row d-flex justify-content-center">
                                            <div class="card-title">Booking Purchase History</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table-responsive table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>User Name</th>
                                                    <th>Room Name</th>
                                                    <th>Room Image</th>
                                                    <th>Total Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recentConfirmedBookings as $booking)
                                                    <tr>
                                                        <td>{{ $booking->user->name }}</td>
                                                        <td>{{ $booking->room->name }}</td>
                                                        <td>
                                                            @if ($booking->room->media)
                                                                <img class="img-thumbnail"
                                                                    src="{{ asset('uploads/' . $booking->room->media->img_link) }}"
                                                                    alt="{{ $booking->room->name }}"
                                                                    style="width: 200px; height: auto;">
                                                            @else
                                                                <span>No Image</span>
                                                            @endif
                                                        </td>
                                                        <td>${{ number_format($booking->total_price, 0) }}</td>
                                                        <td>{{ $booking->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- footer  --}}
        @endsection

    </body>

    </html>
