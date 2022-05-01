<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserType;
use App\Models\BankAdmin;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that belongs to user type.
     */
    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * Get the profile that belongs to user type.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * Get the user that belongs to user type.
     */
    public function bank_admin()
    {
        return $this->hasOne(BankAdmin::class, 'user_id', 'id');
    }

    public function cards()
    {
        return $this->hasMany(UserCard::class, 'user_id', 'id');
    }

    public function hasCard($card_id)
    {
        return UserCard::where(['user_id' => $this->id, 'card_id' => $card_id])->exists();
    }


    public function hasApplication($id)
    {
        return CardApplication::where('user_id', $this->id)->where('card_id', $id)->exists();
    }


    public function myApplications()
    {
        return $this->hasMany(CardApplication::class);
    }
}
