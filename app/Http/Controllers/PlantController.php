<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use Illuminate\Support\Str;


class PlantController extends Controller
{
    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'scientific_name' => 'required|string|max:255',
        'watering_frequency' => 'required|string',
        'sunlight' => 'required|string',
        'soil_type' => 'required|string',
        'fertilizing' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'additional_info' => 'nullable|string',
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imageName = Str::uuid() . '.' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('images/plants', $imageName, 'public');
    }

    // Create the plant record
    try {
        $plant = Plant::create([
            'name' => $validatedData['name'],
            'scientific_name' => $validatedData['scientific_name'],
            'watering_frequency' => $validatedData['watering_frequency'],
            'sunlight' => $validatedData['sunlight'],
            'soil_type' => $validatedData['soil_type'],
            'fertilizing' => $validatedData['fertilizing'],
            'image' => $imagePath,
            'additional_info' => $validatedData['additional_info'] ?? null,
        ]);

        return redirect()->route('plants.create')
            ->with('success', 'Plant added successfully!');

    } catch (\Exception $e) {
        return back()->withInput()
            ->with('error', 'Error creating plant: ' . $e->getMessage());
    }
}

    public function show($id)
    {
        // Load the plant and its related comments (with the user who posted each comment)
        $plant = Plant::with('comments.user')->findOrFail($id);

        // Check if the user is authenticated and retrieve their collection type for the plant
        if (auth()->check()) {
            $userCollectionType = auth()->user()->plants()
                ->where('plant_id', $id)
                ->pluck('collection_type')
                ->first(); // Get the first (or only) collection type for this plant
        } else {
            $userCollectionType = null; // If no user is authenticated, set to null
        }

        // Return the view with the plant and the user's collection type (if authenticated)
        return view('plants.show', compact('plant', 'userCollectionType'));
    }

    public function index(Request $request)
    {
        $query = Plant::query();

        // Optional search
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Optional filter (example: sunlight or watering needs)
        if ($request->has('sunlight')) {
            $query->where('sunlight', $request->sunlight);
        }

        $plants = $query->latest()->paginate(12);

        return view('plants.index', compact('plants'));
    }



}
