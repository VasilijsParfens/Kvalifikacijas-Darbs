<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantIdentification;
use Auth;

class PlantIdentificationController extends Controller
{
    public function create()
    {
        return view('posts.plant_id_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('plant_images', 'public');

        PlantIdentification::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'image' => $imagePath,
            'location' => $request->location,
        ]);

        return redirect()->route('plant-identifications.create')->with('success', 'Your plant identification request has been submitted!');
    }
}
