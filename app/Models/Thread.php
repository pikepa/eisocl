<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Thread extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function path()
    {
        return 'threads/'.$this->id;
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function replies() :HasMany
    {
        return $this->hasMany(Reply::class);
    }
    public function creator() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
