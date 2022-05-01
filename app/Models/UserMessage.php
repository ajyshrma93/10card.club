<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_id',
        'message',
        'parent_message_id'
    ];

    protected $appends = array('created_time');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format('jS, F Y');
    }
}
