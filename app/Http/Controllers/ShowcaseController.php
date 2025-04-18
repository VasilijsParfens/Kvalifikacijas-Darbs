<?php

namespace App\Http\Controllers;

use App\Models\Showcase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShowcaseController extends Controller
{
    /**
     * Show the form for creating a new showcase post.
     */
    public function create()
    {
        return view('posts.showcase_form');
    }

    /**
     * Store a newly created showcase post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure image is uploaded and is of the correct type
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/showcase_images');
        }

        // Create the showcase post
        Showcase::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->caption,
            'image' => $imagePath ?? null,
        ]);

        return redirect()->route('/')->with('success', 'Your plant showcase has been shared!');
    }
}
