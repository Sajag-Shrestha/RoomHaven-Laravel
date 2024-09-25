@extends('frontend.includes.main')

@section('content')
    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5"
        style="background-image: url({{ asset('frontend-assets/images/big_image_1.jpg') }});">
        <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Reservation</h1>
                        <p>Discover our world's #1 Luxury Room For VIP.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="site-section">
        <div class="container">
            <!-- Display success message if exists -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <meta http-equiv="refresh" content="5;url={{ route('bookingCreate', ['room_id' => session('room_id', $room->id)]) }}">
            @endif

            @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    <meta http-equiv="refresh" content="5;url={{ route('bookingCreate', ['room_id' => session('room_id') ?? $room->id]) }}">
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-5">Reservation Form</h2>
                    <form action="{{ route('bookingStore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="check_in_date">Check In Date:</label>
                                <input type="date" class="form-control" name="check_in_date" required>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label for="check_out_date">Check Out Date:</label>
                                <input type="date" class="form-control" name="check_out_date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="guests_count">Number of Guests:</label>
                            <input type="number" name="guests_count" min="1" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirm Booking</button>

                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-5">
                    <h3 class="mb-5">Featured Room</h3>
                    <div class="media d-block room mb-0">
                        <figure>
                            @if ($room->media)
                                <img src="{{ asset('uploads/' . $room->media->img_link) }}" alt="{{ $room->name }}"
                                    class="img-fluid">
                            @else
                                <img src="path/to/placeholder.jpg" alt="No image available" class="img-fluid">
                            @endif

                            <!-- Status Badge -->
                            <div class="overlap-text status-badge" style="position: absolute; top: 15px; left: 20px;">
                                @if ($room->status === 'available')
                                    <span class="badge"
                                        style="background-color: green; color: white; padding: 5px 8px;">Available</span>
                                @elseif ($room->status === 'maintenance')
                                    <span class="badge"
                                        style="background-color: #FFD700; color: white; padding: 5px 8px;">Maintenance</span>
                                @elseif ($room->status === 'booked')
                                    <span class="badge"
                                        style="background-color: red; color: white; padding: 5px 8px;">Booked</span>
                                @endif
                            </div>

                            <div class="overlap-text">
                                <span>
                                    Featured Room
                                    @for ($i = 0; $i < $room->rating; $i++)
                                        <span class="ion-ios-star"></span>
                                    @endfor
                                </span>
                            </div>
                        </figure>
                        <div class="media-body">
                            <h3 class="mt-0"><a href="#">{{ $room->name }}</a></h3>
                            <ul class="room-specs">
                                <li><span class="ion-ios-people-outline"></span> {{ $room->capacity }} Guests</li>
                                <li><span class="ion-ios-crop"></span> {{ $room->room_size }} m<sup>2</sup></li>
                            </ul>
                            <p>{{ $room->description }}</p>
                            <p><a href="#" class="btn btn-primary btn-sm">Book Now From ${{ $room->price }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->
@endsection
