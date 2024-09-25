<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Number of Users
        $userCount = User::count();

        // Number of Rooms
        $roomCount = Room::count();

        // Number of Bookings
        $bookingCount = Booking::count();

        // Sum of total_price for confirmed bookings
        $totalPriceConfirmedBookings = Booking::where('status', 'confirmed')->sum('total_price');

        // Latest 5 bookings
        $latestPendingBookings = Booking::where('status', 'pending')
            ->orderBy('created_at', 'desc')->take(5)->get();

        // Recently added 5 rooms
        $recentRooms = Room::orderBy('created_at', 'desc')->take(5)->get();

        // Recent confirmed room bookings with total price
        $recentConfirmedBookings = Booking::where('status', 'confirmed')
            ->with(['user', 'room.media']) // Include media relation
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $newUsers = User::orderBy('created_at', 'desc')->take(5)->get();


        return view('backend.index', compact(
            'userCount',
            'roomCount',
            'bookingCount',
            'totalPriceConfirmedBookings',
            'latestPendingBookings',
            'recentRooms',
            'recentConfirmedBookings',
            'newUsers'
        ));
    }
}
