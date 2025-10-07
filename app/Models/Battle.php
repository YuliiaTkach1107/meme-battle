<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Battle extends Model
{
    use hasFactory;
    
    protected $fillable = [
        'title',
        'descripton',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }

    protected function casts(): array{
        return [
            'start_date'=>'datetime',
            'end_date'=>'datetime'
        ];
    }
    public function memes()
    {
    return $this->hasMany(Meme::class);
    }

    public function votes()
    {
    return $this->hasManyThrough(Vote::class, Meme::class);
    }


    public function winnerMeme(){
    return $this->memes()->withCount('votes')->orderByDesc('votes_count')->first();
    }

}


 
