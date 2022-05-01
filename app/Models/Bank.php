<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name', 'bank_hotline', 'shortcut_speak', 'redeem_web', 'min_age', 'min_age_sub', 'point_name', 'point_rebate_percentage', 'point_value_rm', 'late_charge_fee', 'interest_rate', 'cash_out_interest', 'cash_out_first_charge', 'hotline_time'];

    protected $casts = [
        'hotline_time' => 'array'
    ];


    /**
     * Get the user that owns the phone.
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'bank_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(BankAdmin::class);
    }
}
