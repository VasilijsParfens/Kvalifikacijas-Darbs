<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    use HasFactory;

    // Defining the table name (optional, as Laravel can infer it)
    protected $table = 'question_comments';

    // Defining the fillable attributes
    protected $fillable = [
        'question_id',
        'user_id',
        'content',
    ];

    /**
     * Get the question that the comment belongs to.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the user that created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
