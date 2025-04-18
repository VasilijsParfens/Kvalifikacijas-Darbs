<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantComment;


class AdminPlantCommentController extends Controller
{
    public function index()
    {
        $comments = PlantComment::all();
        return view('admin.plant-comments', compact('comments'));
    }

    public function destroy($id)
    {
        $comment = PlantComment::findOrFail($id);
        $commet->delete();

        return response()->json(['message' => 'Plant comment deleted successfully']);
    }
}
