<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id', 'added_teams_count', 'remains_teams_count', 'added_communities_count',
        'remains_communities_count', 'added_sub_communities_count',
        'remains_sub_communities_count', 'added_members_count',
        'remains_members_count'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
