@extends('frontend.includes.main')
@section('content')
    <section class="site-hero overlay" data-stellar-background-ratio="0.5"
        style="background-image: url({{ asset('frontend-assets/images/big_image_1.jpg') }});">
        <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
                <div class="col-md-12 text-center">

                    <div class="mb-5 element-animate">
                        <h1>Welcome To Our Luxury Rooms</h1>
                        <p>Discover our world's #1 Luxury Room For VIP.</p>
                        <p><a href="{{ route('rooms') }}" class="btn btn-primary">Book Now</a></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="site-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="heading-wrap text-center element-animate">
                        <h4 class="sub-heading">Stay with our luxury rooms</h4>
                        <h2 class="heading">Stay and Enjoy</h2>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus illo similique
                            natus, a recusandae? Dolorum, unde a quibusdam est? Corporis deleniti obcaecati quibusdam
                            inventore fuga eveniet! Qui delectus tempore amet!</p>
                        <p><a href="{{ route('about') }}" class="btn btn-primary btn-sm">More About Us</a></p>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-7">
                    <img src="{{ asset('frontend-assets/images/f_img_1.png') }}" alt="Image placeholder"
                        class="img-md-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- END section -->

    <section class="site-section bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 heading-wrap text-center">
                    <h4 class="sub-heading">Our Luxury Rooms</h4>
                    <h2 class="heading">Featured Rooms</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($rooms as $index => $room)
                    @if ($index === 0)
                        <!-- First room with all details -->
                        <div class="col-md-7">
                            <div class="media d-block room mb-0">
                                <figure>
                                    <img src="{{ asset('uploads/' . $room->media->img_link) }}" alt="{{ $room->name }}"
                                        class="img-fluid">
                                    <div class="overlap-text">
                                        Featured Room
                                        @for ($i = 0; $i < $room->rating; $i++)
                                            <span class="ion-ios-star"></span>
                                        @endfor
                                    </div>
                                </figure>
                                <div class="media-body">
                                    <h3 class="mt-0"><a href="#">{{ $room->name }}</a></h3>
                                    <ul class="room-specs">
                                        <li><span class="ion-ios-people-outline"></span> {{ $room->capacity }} Guests</li>
                                        <li><span class="ion-ios-crop"></span> {{ $room->room_size }} m<sup>2</sup></li>
                                    </ul>
                                    <p>{{ $room->description }}</p>
                                    <p><a href="{{ route('rooms') }}" class="btn btn-primary btn-sm">Book Now For
                                            ${{ $room->price }}</a></p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Limited layout for subsequent rooms -->
                <div class="col-md-5 room-thumbnail-absolute">
                    @foreach ($rooms as $index => $room)
                        @if ($index === 1 || $index === 2)
                            <a href="{{ route('rooms') }}"
                                class="media d-block room bg {{ $index === 1 ? 'first-room' : 'second-room' }}"
                                style="background-image: url('{{ asset('uploads/' . $room->media->img_link) }}');">
                                <div class="overlap-text">
                                    <span>
                                        Hotel Room
                                        @for ($i = 0; $i < $room->rating; $i++)
                                            <span class="ion-ios-star"></span>
                                        @endfor
                                    </span>
                                    <span class="pricing-from">
                                        from ${{ $room->price }}
                                    </span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
