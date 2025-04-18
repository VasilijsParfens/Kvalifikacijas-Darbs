<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        // Load followers and following counts
        $user->loadCount(['followers', 'following']);

        // Load the plant collections
        $collections = [
            'plantsIHave' => $user->plantCollections()->with('plant')->where('collection_type', 'have')->get(),
            'plantsIHad' => $user->plantCollections()->with('plant')->where('collection_type', 'had')->get(),
            'plantsIWant' => $user->plantCollections()->with('plant')->where('collection_type', 'want')->get(),
        ];

        // Load the user's posts
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile.show', [
            'user' => $user,
            'collections' => $collections,
            'posts' => $posts,
        ]);
    }
}
