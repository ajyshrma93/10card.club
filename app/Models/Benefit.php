<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;
use App\Models\Merchant;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'merchant_id',
        'merchant_benefit_description',
        'benefit_day_mon',
        'benefit_day_tue',
        'benefit_day_wed',
        'benefit_day_thu',
        'benefit_day_fri',
        'benefit_day_sat',
        'benefit_day_sun'
    ];

    /**
     * Get the card that belongs to benefit.
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the merchant that belongs to benefit.
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
