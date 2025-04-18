<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create($type)
    {
        // Ensure the type is valid
        $validTypes = ['tip', 'question', 'showcase', 'plant_identification'];

        if (!in_array($type, $validTypes)) {
            abort(404); // Show a 404 error if type is invalid
        }

        return view("posts.forms.$type", compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:tip,question,showcase,plant_identification',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:5000',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.create', ['type' => $request->type])->with('success', 'Post created successfully!');
    }

    public function showList($type)
    {
        // Ensure the type is valid
        $validTypes = ['tip', 'question', 'showcase', 'plant_identification'];

        if (!in_array($type, $validTypes)) {
            abort(404); // Show a 404 error if type is invalid
        }

        // Fetch posts of the specified type
        $posts = Post::where('type', $type)->latest()->get();

        // Return the view with the posts data
        return view("posts.lists.$type", compact('posts', 'type'));
    }
}
