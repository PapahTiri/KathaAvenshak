<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Chapter;
use App\Models\UserGachaReward;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;     // <— import contract

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $casts = [
    'claimed_days' => 'array',
    ];

   public function canAccessPanel(\Filament\Panel $panel): bool
    {
       return (bool) $this->is_admin;
    }

    public function purchasedChapters()
    {
        return $this->belongsToMany(Chapter::class, 'purchased_chapters');
    }

    public function hasPurchased(Chapter $chapter): bool
    {
        return $this->purchasedChapters()->where('chapter_id', $chapter->id)->exists();
    }

     public function gachaRewards()
    {
        return $this->hasMany(UserGachaReward::class);
    }
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

  
}
