<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    protected $with = ['owner'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->question->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->question->decrement('replies_count');
        });
    }

    /**
     * A reply belongs to a User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A reply belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
