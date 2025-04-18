<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerVote;

class QuestionController extends Controller
{
    public function create()
    {
        return view('posts.questions_form');
    }

    public function store(Request $request)
    {
        // Validācija
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        // Izveidojam jaunu jautājumu
        $question = new Question();
        $question->user_id = auth()->id();
        $question->title = $validated['title'];
        $question->content = $validated['details'];
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted!');
    }

    public function index()
    {
        $questions = Question::with('user')->latest()->get();
        return view('posts.questions', compact('questions'));
    }

    public function show($questionId)
    {
        $question = Question::with(['answers.user', 'answers.votes'])->findOrFail($questionId);
        return view('posts.question', compact('question'));
    }
}
