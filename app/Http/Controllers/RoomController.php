<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the 'media' relationship when fetching rooms
        $room = Room::with('media')->get();

        return view('backend.room.index', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Media::all();

        return view('backend.room.create', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request, excluding status
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|between:1,5', // Limit rating to between 1 and 5
            'capacity' => 'nullable|integer|min:1',
            'room_size' => 'nullable|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'image_id' => 'required|exists:media,id', // Ensure the selected image exists in media table
        ]);

        // Store room data without specifying status
        Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'rating' => $request->rating,
            'capacity' => $request->capacity,
            'room_size' => $request->room_size,
            'price' => $request->price,
            'image_id' => $request->image_id,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::with('media')->findOrFail($id);
        $images = Media::all(); // Fetch available images from the media table

        return view('backend.room.edit', compact('room', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'image_id' => 'nullable|exists:media,id',
            'rating' => 'nullable|integer|min:1|max:5',
            'capacity' => 'nullable|integer',
            'room_size' => 'nullable|numeric',
            'price' => 'required|numeric',
        ]);

        $room = Room::findOrFail($id);
        $room->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_id' => $request->input('image_id'),
            'rating' => $request->input('rating'),
            'capacity' => $request->input('capacity'),
            'room_size' => $request->input('room_size'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function showRooms()
    {
        // Fetch the rooms from the database
        $rooms = Room::with('media')->get();

        // Pass the $rooms variable to the view
        return view('frontend.rooms', compact('rooms'));
    }

    public function indexRooms() {
        $rooms = Room::with('media')->get(); // Fetch rooms with their media
        return view('frontend.index', compact('rooms'));
    }
    

    

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:available,booked,maintenance',
        ]);

        $room = Room::findOrFail($id);
        $room->status = $request->status;
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room status updated successfully!');
    }
}
