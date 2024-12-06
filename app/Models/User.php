<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\ActivityStatusEnums;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function GameMatches()
    {
        return $this->hasMany(GameMatch::class);
    }

    // help: Scopes for future use
    public function scopeMyWonMatches($query) { return $this->GameMatches()->won(); }
    public function scopeMyLostMatches($query) { return $this->GameMatches()->lost(); }

    public function scopeGetOnlineUsers($query)
    {
        return $query->where('status', ActivityStatusEnums::ONLINE);
    }
}
