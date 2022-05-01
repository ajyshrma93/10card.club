<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;

class BankAdmin extends Model
{
    use HasFactory;

    /**
     * Get the merchant that belongs to benefit.
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
