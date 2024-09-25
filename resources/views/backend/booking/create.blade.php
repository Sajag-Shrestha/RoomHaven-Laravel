@extends('backend.includes.main')

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
                    <a href="{{ route('booking.create') }}">Add Booking</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Booking</h4>
                    </div>
                    <div class="card-body">
                        <!-- Booking Form -->
                        <form class="row g-3" method="POST" action="{{ route('booking.store') }}">
                            @csrf

                            <!-- Room -->
                            <div class="col-md-6">
                                <label for="room_id" class="form-label fw-bold">Room</label>
                                <select class="form-select @error('room_id') is-invalid @enderror" name="room_id" id="room_id" required>
                                    <option disabled selected value="">Select Room</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- User (Guest) -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label fw-bold">Guest</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required>
                                    <option disabled selected value="">Select Guest</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Check-in Date -->
                            <div class="col-md-6">
                                <label for="check_in_date" class="form-label fw-bold">Check-in Date</label>
                                <input type="date" class="form-control @error('check_in_date') is-invalid @enderror" name="check_in_date" id="check_in_date" value="{{ old('check_in_date') }}" required>
                                @error('check_in_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Check-out Date -->
                            <div class="col-md-6">
                                <label for="check_out_date" class="form-label fw-bold">Check-out Date</label>
                                <input type="date" class="form-control @error('check_out_date') is-invalid @enderror" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}" required>
                                @error('check_out_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Guests Count -->
                            <div class="col-md-6">
                                <label for="guests_count" class="form-label fw-bold">Guests Count</label>
                                <input type="number" class="form-control @error('guests_count') is-invalid @enderror" name="guests_count" id="guests_count" value="{{ old('guests_count') }}" required>
                                @error('guests_count')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 pt-2">
                                <button type="submit" class="btn btn-primary fw-bold">Add Booking</button>
                            </div>
                        </form><!-- End Booking Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
