<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        // Fetch rooms and users for the form
        $rooms = Room::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('backend.booking.create', compact('rooms', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests_count' => 'required|integer|min:1'
        ]);

        // Fetch room data
        $room = Room::findOrFail($request->room_id);

        // Validate guest count against room capacity
        if ($request->guests_count > $room->capacity) {
            return back()->withErrors(['guests_count' => 'The number of guests exceeds the room capacity.'])->withInput();
        }

        // Calculate the number of nights
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);

        // Calculate total price based on room price and nights
        $totalPrice = $nights * $room->price;

        // Check room status
        if ($room->status === 'booked') {
            return back()->withErrors(['room_id' => 'The room is already booked.'])->withInput();
        } 
        
        if ($room->status === 'maintenance') {
            // Create the booking with pending status
            $booking = Booking::create([
                'room_id' => $request->room_id,
                'user_id' => $request->user_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'guests_count' => $request->guests_count,
                'total_price' => $totalPrice,
                'status' => Booking::PENDING, // Set status to pending due to maintenance
            ]);

            return redirect()->route('booking.index')->with('warning', 'Your booking is currently pending as the room is under maintenance. We will notify you once it is available.');
        }



        // Create the booking
        Booking::create([
            'room_id' => $request->room_id,
            'user_id' => $request->user_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests_count' => $request->guests_count,
            'total_price' => $totalPrice,
            'status' =>  Booking::CONFIRMED, // Confirmed if the room is available
        ]);

        // Update room status to booked
        $room->status = 'booked';
        $room->save();

        // Redirect with success message
        return redirect()->route('booking.index')->with('success', 'Booking added successfully.');
    }

    public function index()
    {
        $bookings = Booking::with(['room', 'user'])->get(); // Fetch bookings with related room and user data
        return view('backend.booking.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:'.implode(',',Booking::STATUSES),
        ]);

        $booking = Booking::findOrFail($id);
        $room = Room::findOrFail($booking->room_id);

        // Update booking status
        $booking->status = $request->status;
        $booking->save();

        // Update room status based on booking status
        if ($request->status === Booking::CONFIRMED) {
            if ($room->status === 'available') {
                $room->status = 'booked';
                $room->save();
                return redirect()->route('booking.index')->with('success', 'Booking status updated to confirmed, room is now booked.');
            } else {
                return redirect()->route('booking.index')->with(['room_id' => 'Cannot confirm booking as the room is not available.']);
            }
        } elseif ($request->status === Booking::CANCELLED) {
            $room->status = 'available'; // Assuming available is a valid status
            $room->save();
        }

        return redirect()->route('booking.index')->with('success', 'Booking status updated successfully.');
    }

    public function delete($id)
    {
        $booking = Booking::findOrFail($id);
        $room = Room::findOrFail($booking->room_id);

        // Restore the room status to available when booking is deleted
        $room->status = 'available';
        $room->save();

        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }

    // Show the booking form with the selected room
    public function bookingCreate(Request $request)
    {
        // Get the room ID from the request
        $roomId = $request->input('room_id');

        // Find the room by ID
        $room = Room::findOrFail($roomId);

        return view('frontend.booking', compact('room'));
    }

    // Store the booking
    public function bookingStore(Request $request)
    {
        // Validate the request data
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests_count' => 'required|integer|min:1',
        ]);

        // Fetch the room by ID
        $room = Room::findOrFail($request->input('room_id'));

        // Validate guest count against room capacity
        if ($request->guests_count > $room->capacity) {
            return back()->withErrors(['guests_count' => 'The number of guests exceeds the room capacity.'])
            ->withInput()
            ->with(['room_id' => $request->room_id]);
        }

        // Check room status
        if ($room->status === 'booked') {
            return back()->withErrors(['room_id' => 'The room is already booked.'])
            ->withInput()
            ->with(['room_id' => $request->room_id]);

        } elseif ($room->status === 'maintenance') {
            return back()->withErrors(['room_id' => 'The room is currently under maintenance.'])
            ->withInput()
            ->with(['room_id' => $request->room_id]);
        }

        // Calculate the total price based on the room rate and the duration of stay
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);
        $numberOfNights = $checkInDate->diffInDays($checkOutDate);

        $totalPrice = $room->price * $numberOfNights;

        // Create the booking with total_price included
        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guests_count' => $request->guests_count,
            'total_price' => $totalPrice, // Add this line
            'status' => Booking::CONFIRMED,
        ]);

        // Update room status to booked after the booking is created
        $room->status = 'booked';
        $room->save();
        return redirect()->route('bookingCreate', ['room_id' => $request->room_id])->with('success', 'Booking Successfully!');
    }
}
