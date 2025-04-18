<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['content', 'user_id', 'question_id', 'is_best'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function votes()
    {
        return $this->hasMany(AnswerVote::class);
    }

    public function upvotesCount()
    {
        return $this->votes()->where('vote', true)->count();
    }

    public function downvotesCount()
    {
        return $this->votes()->where('vote', false)->count();
    }
}
