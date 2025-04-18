<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AnswerVote;
use Illuminate\Support\Facades\RateLimiter;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated for all actions
    }

    // Store a new answer
    public function store(Request $request, $questionId)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $answer = new Answer();
        $answer->question_id = $questionId;
        $answer->user_id = auth()->id();
        $answer->content = $validated['content'];
        $answer->save();

        return redirect()->route('posts.question', $questionId)->with('success', 'Your answer has been submitted!');
    }

    // Upvote an answer
    public function upvote($answerId)
    {
        $answer = Answer::findOrFail($answerId);

        // Rate limit voting to prevent spamming
        if (RateLimiter::tooManyAttempts('upvote:' . auth()->id(), 3)) {
            return redirect()->back()->with('error', 'Too many voting attempts. Please try again later.');
        }

        $vote = AnswerVote::where('user_id', auth()->id())
                          ->where('answer_id', $answerId)
                          ->first();

        if ($vote && $vote->vote == 1) {
            return redirect()->back()->with('error', 'You have already upvoted this answer.');
        }

        // Remove downvote if exists
        if ($vote && $vote->vote == -1) {
            $vote->delete();
        }

        AnswerVote::updateOrCreate(
            ['answer_id' => $answerId, 'user_id' => auth()->id()],
            ['vote' => 1]
        );

        RateLimiter::hit('upvote:' . auth()->id(), 60); // Prevent spamming

        return redirect()->back()->with('success', 'Answer upvoted!');
    }

    // Downvote an answer
    public function downvote($answerId)
    {
        $answer = Answer::findOrFail($answerId);

        // Rate limit voting to prevent spamming
        if (RateLimiter::tooManyAttempts('downvote:' . auth()->id(), 3)) {
            return redirect()->back()->with('error', 'Too many voting attempts. Please try again later.');
        }

        $vote = AnswerVote::where('user_id', auth()->id())
                          ->where('answer_id', $answerId)
                          ->first();

        if ($vote && $vote->vote == -1) {
            return redirect()->back()->with('error', 'You have already downvoted this answer.');
        }

        // Remove upvote if exists
        if ($vote && $vote->vote == 1) {
            $vote->delete();
        }

        AnswerVote::updateOrCreate(
            ['answer_id' => $answerId, 'user_id' => auth()->id()],
            ['vote' => -1]
        );

        RateLimiter::hit('downvote:' . auth()->id(), 60); // Prevent spamming

        return redirect()->back()->with('success', 'Answer downvoted!');
    }

    // Mark the best answer
    public function markBestAnswer($answerId, $questionId)
    {
        $question = Question::findOrFail($questionId);
        $answer = Answer::findOrFail($answerId);

        // Only the question creator can mark the best answer
        if ($question->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to mark the best answer.');
        }

        // Mark the answer as the best
        $answer->is_best = true;
        $answer->save();

        // Set other answers to not best
        Answer::where('question_id', $questionId)
              ->where('id', '!=', $answerId)
              ->update(['is_best' => false]);

        return redirect()->route('questions.show', $questionId)->with('success', 'Best answer marked!');
    }
}
