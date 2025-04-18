<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class AdminPlantController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        return view('admin.plants', compact('plants'));
    }

    public function store(Request $request)
    {
        Plant::create($request->validate([
            'name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255',
            'image' => 'required|url',
            'watering' => 'required|string',
            'sunlight' => 'required|string',
            'description' => 'nullable|string',
        ]));
        return redirect()->route('admin.plants')->with('success', 'Plant added successfully!');
    }

    public function update(Request $request, $plantId)
{
    // Validate the incoming data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'scientific_name' => 'required|string|max:255',
        'watering_frequency' => 'required|string|max:255',
        'sunlight' => 'required|string|max:255',
    ]);

    // Find the plant by ID
    $plant = Plant::findOrFail($plantId);

    // Update the plant attributes
    $plant->name = $validated['name'];
    $plant->scientific_name = $validated['scientific_name'];
    $plant->watering_frequency = $validated['watering_frequency'];
    $plant->sunlight = $validated['sunlight'];

    // Save the plant
    $plant->save();

    // Redirect or return a response
    return redirect()->route('admin.plants')->with('success', 'Plant updated successfully');
}


    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('admin.plants')->with('success', 'Plant deleted successfully!');
    }
}
