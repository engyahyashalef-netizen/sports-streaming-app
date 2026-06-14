<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    protected $fillable = ['name', 'stream_url', 'logo', 'description', 'is_active'];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
