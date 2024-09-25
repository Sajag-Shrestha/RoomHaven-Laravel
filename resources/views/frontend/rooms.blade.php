@extends('frontend.includes.main')
@section('content')
    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5"
        style="background-image: url({{ asset('frontend-assets/images/big_image_1.jpg') }});">
        <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Our Rooms</h1>
                        <p>Discover our world's #1 Luxury Room For VIP.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="site-section">
        <div class="container">
            <div class="row">
                <!-- Room Card Start -->
                @foreach ($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="media d-block room mb-0 text-center">
                            <figure class="mb-3" style="margin: 0; position: relative; height: 250px; overflow: hidden;">
                                @if ($room->media)
                                    <img src="{{ asset('uploads/' . $room->media->img_link) }}" alt="{{ $room->name }}"
                                        class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; ">
                                @else
                                    <img src="path/to/placeholder.jpg" alt="No image available" class="img-fluid"
                                        style="height: 200px; object-fit: cover;">
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
                                    <li><span class="ion-ios-crop"></span> {{ $room->room_size }} m <sup>2</sup></li>
                                </ul>
                                <p>{{ $room->description }}</p>
                                @if (Auth::check())
                                    <p>
                                        <a href="{{ route('bookingCreate', ['room_id' => $room->id]) }}"
                                            class="btn btn-primary btn-sm">Book Now For ${{ $room->price }}</a>
                                    </p>
                                @else
                                    <p><a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Book For
                                            ${{ $room->price }}</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Room Card End -->
            </div>
        </div>
    </section>
@endsection
