<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::all();

        return view('backend.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:30',
            'img_link' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048', // Only images allowed
        ]);
    
        // Handle the file upload
        if ($request->hasFile('img_link')) {
            // Create a unique name for the image
            $imageName = time().'.'.$request->img_link->extension();
            // Move the image to the public directory
            $request->img_link->move(public_path('uploads'), $imageName);
        }
    
        // Store media data in the database
        Media::create([
            'title' => $request->title,
            'img_link' => $imageName,  // Save the file name in the database
            'type' => $request->file('img_link')->getClientOriginalExtension(),  // Since we only have images, type is fixed to 'image'
        ]);
    
        return redirect()->route('media.index')->with('success', 'Image uploaded successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        {
            $media = Media::findOrFail($id);
            
            // Delete the image file from storage
            $imagePath = public_path('uploads/' . $media->img_link);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            }
        
            // Delete the record from the database
            $media->delete();
        
            return redirect()->route('media.index')->with('success', 'Media deleted successfully!');
        }
    }
}
