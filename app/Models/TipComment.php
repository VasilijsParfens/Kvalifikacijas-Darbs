<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipComment extends Model
{
    use HasFactory;

    protected $fillable = ['tip_id', 'user_id', 'content'];

    // A comment belongs to one tip
    public function tip()
    {
        return $this->belongsTo(Tip::class);
    }

    // A comment belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
