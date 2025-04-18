<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\TipComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipsController extends Controller
{
    /**
     * Show the form for creating a new tip.
     */
    public function create()
    {
        return view('posts.tips_form');
    }

    /**
     * Store a newly created tip in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Store the tip in the database
        Tip::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('tips.index')->with('success', 'Your tip has been shared!');
    }

    /**
     * Display a list of all tips.
     */
    public function index()
    {
        $tips = Tip::with('user')->latest()->get();
        return view('posts.tips', compact('tips'));
    }

    public function show($id)
    {
        // Get the tip by its ID
        $tip = Tip::with('comments.user')->findOrFail($id); // Eager load comments and users
        // Return the view and pass the tip data to it
        return view('posts.tip', compact('tip'));
    }

    public function storeComment(Request $request, $tipId)
    {
        // Ensure the user is authenticated before proceeding
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        // Validate the incoming data
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Find the associated Tip by its ID
        $tip = Tip::findOrFail($tipId);

        // Create and associate the new comment
        $comment = new TipComment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id(); // Assuming you have user authentication set up
        $tip->comments()->save($comment);

        // Redirect back with a success message
        return redirect()->route('tips.show', $tipId)->with('success', 'Comment posted successfully!');
    }
}
