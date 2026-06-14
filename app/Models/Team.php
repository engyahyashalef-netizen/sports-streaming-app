<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = ['name', 'logo', 'description'];

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'team_a_id');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'team_b_id');
    }

    public function allGames()
    {
        return $this->homeGames()->union($this->awayGames());
    }
}
