<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Card;

class UserCardNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_id',
        'title',
        'description'
    ];

    protected $appends = array('created_time');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format('jS, F Y');
    }
}
