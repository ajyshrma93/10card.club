<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Benefit;
use App\Models\Bank;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_name',
        'card_image',
        'card_info_url',
        'card_type_id',
        'bank_id',
        'point_or_cashrebate',
        'point_or_cashrebate_description',
        'point_name',
        'annual_fee',
        'annual_fee_sub',
        'annual_fee_free_1_year',
        'annual_fee_waived',
        'point_value_rm',
        'point_rebate_percentage',
        'late_charge_fee',
        'interest_type',
        'interest_rate',
        'cashout_can',
        'cash_out_interest',
        'cash_out_first_charge',
        'statement_days_can',
        'card_des',
        'min_income'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function benefits()
    {
        return $this->hasMany(Benefit::class, 'card_id', 'id');
    }

    /**
     * Get the merchant that belongs to benefit.
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Get the merchant that belongs to benefit.
     */
    public function type()
    {
        return $this->hasOne(CardType::class, 'id', 'card_type_id');
    }
}
