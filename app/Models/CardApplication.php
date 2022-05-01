<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardApplication extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            try {
                $chat = new Chat();
                $chat->application_id = $model->id;
                $chat->message = 'Your application for the credit card has been submitted successfully. You will be update soon regarding the application status soon. If have any query please feel free to ask .<br/> Thanks for applying for the card ' . $model->card->card_name;
                $chat->user_id = $model->bank->admin->user_id;
                $chat->save();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'card_id',
        'company_name',
        'bank_id',
        'user_id',
        'salary_slip',
        'offer_letter',
        'epf',
    ];
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
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the merchant that belongs to benefit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the merchant that belongs to benefit.
     */
    public function conversations()
    {
        return $this->hasMany(Chat::class, 'application_id', 'id');
    }
}
