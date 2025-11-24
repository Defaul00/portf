<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'response',
        'is_ai',
    ];

    protected $casts = [
        'is_ai' => 'boolean',
    ];

    /**
     * Get the user that owns the chat message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
