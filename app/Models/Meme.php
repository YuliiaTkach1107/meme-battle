<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Battle;

class Meme extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_path',
        'user_id',
        'battle_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function battle(){
        return $this->belongsTo(Battle::class);
    }

    public function votes()
    {
    return $this->hasMany(Vote::class);
    }

    public function getScoreAttribute()
    {
    return $this->votes()->count();
    }

    
}
