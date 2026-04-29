<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    /**
     * Get the posts for the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the posts liked by the user.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes')->using(Like::class)->withTimestamps()->withPivot('reaction');
    }

    /**
     * Users that this user has liked.
     */
    public function likedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_likes', 'user_id', 'liked_user_id')
            ->using(UserLike::class)
            ->withTimestamps();
    }

    /**
     * Mutual matches (both users liked each other).
     */
    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_likes', 'user_id', 'liked_user_id')
            ->using(UserLike::class)
            ->withTimestamps()
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('user_likes as reverse')
                    ->whereColumn('reverse.user_id', 'user_likes.liked_user_id')
                    ->whereColumn('reverse.liked_user_id', 'user_likes.user_id');
            });
    }
}
