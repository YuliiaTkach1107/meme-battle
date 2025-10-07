<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Battle;
use App\Models\Meme;


class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meme_id',
        'battle_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function meme(){
        return $this->belongsTo(Meme::class);
    }
    public function battle(){
        return $this->belongsTo(Battle::class);
    }
    
}
