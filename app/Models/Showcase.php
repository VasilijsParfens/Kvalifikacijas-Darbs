<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
    ];

    // Optional: Define a relationship if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
