<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = ['slug','category_id', 'merchant_image', 'merchant_name'];

    /**
     * Get the card that belongs to benefit.
     */
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * Set the merchants's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setMerchantNameAttribute($value)
    {
        $this->attributes['merchant_name'] = trim($value);
    }
}
