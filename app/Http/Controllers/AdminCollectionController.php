<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPlantCollection;

class AdminCollectionController extends Controller
{
    public function index()
    {
        $collections = UserPlantCollection::all();
        return view('admin.collections', compact('collections'));
    }

    public function destroy($id)
    {
        $collection = UserPlantCollection::findOrFail($id);
        $collection->delete();

        return response()->json(['message' => 'Collection deleted successfully']);
    }
}
