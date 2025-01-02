<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ChannelLevel;

class ChannelMember extends Model
{
    protected $table = 'channels_members';

    protected $fillable = [
        'channel_id', 'member_id', 'member_group',
        'channel_level', 'is_joined', 'team_id'
    ];

    public function communities(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'team_id', 'team_id')
            ->where('channel_level', ChannelLevel::COMMUNITY);
    }

    public function joinedCommunities(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'team_id', 'team_id')
            ->where(['channel_level' => ChannelLevel::COMMUNITY, 'member_id' => auth()->id()]);
    }

    public function subCommunities(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'team_id', 'team_id')
            ->where('channel_level', ChannelLevel::SUBCOMMUNITY);
    }

    public function joinedSubCommunities(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'team_id', 'channel_id')
            ->where(['channel_level' => ChannelLevel::SUBCOMMUNITY, 'member_id' => auth()->id()]);
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function members(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
