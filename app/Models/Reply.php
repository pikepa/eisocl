<?php

namespace App\Models;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {   $attributes = ['user_id' => auth()->id()];
        if(! $this->favorites()->where($attributes)->exists())
        return $this->favorites()->create($attributes);
    }
}
