<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method for handling the admin dashboard view
    public function dashboard()
    {
        return view('backend.index'); // Assuming you have a view named 'admin.dashboard'
    }

    // Method for handling admin settings view
    // public function settings()
    // {
    //     return view('backend.settings'); // Assuming you have a view named 'admin.settings'
    // }

    // Add more methods as needed
}
