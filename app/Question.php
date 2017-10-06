<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Sluggable;

    /**
     * Ignore mass assignment;
     *
     * @var array
     */
    protected $guarded = [];

    protected $with = ['author', 'channel', 'replies'];

    /**
     *  Boot the model.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->replies->each->delete();
        });
    }

    /**
     * Get the route key name for Laravel
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Getting the path of a specific question.
     *
     * @return string
     * @internal param string $option
     */
    public function path()
    {
        return "/questions/{$this->slug}";
    }

    /**
     * A questions belongs to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A questions belongs to a channel.
     *
     * @return mixed
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    /**
     * Add a reply to the question
     *
     * @param array $reply
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        return $reply;
    }

    /**
     * A Questions Could have many replies (Comments)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
