<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', 'author', 'title', 'type', 'status', 'reason',
        'publisher', 'year', 'binding', 'condition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
