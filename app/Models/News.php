<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bank;
use App\Models\CardType;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','user_id','cover_image','bank_id','card_type_id','description'];

    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function card_type(){
        return $this->belongsTo(CardType::class);
    }
}
