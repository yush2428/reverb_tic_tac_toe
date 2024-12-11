<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\MatchEnums;

class GameMatch extends Model
{
    protected $fillable = [
        'user_id', 'opponent_id', 'match_id', 'link', 'user_score', 'opponent_score', 'match_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function opponent()
    {
        return $this->belongsTo(User::class, 'opponent_id');
    }

    // help: Scopes for future use
    public function scopePending($query) { return $query->where('match_status', MatchEnums::PENDING); }
    public function scopeWon($query) { return $query->where('match_status', MatchEnums::WON); }
    public function scopeLost($query) { return $query->where('match_status', MatchEnums::LOST); }
    public function scopeDraw($query) { return $query->where('match_status', MatchEnums::DRAW); }
    public function scopeFinished($query) { return $query->whereIn('match_status', [MatchEnums::WON, MatchEnums::LOST, MatchEnums::DRAW]); }
}
