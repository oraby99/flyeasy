<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Scopes\CheckChannelNotDeletedScope;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ChannelGroup;
use App\Enums\ChannelLevel;
use App\Enums\YesOrNo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Channel extends Model
{
    protected $table = 'channels';

    protected $fillable = [
        'name', 'parent_id', 'level', 'user_id',
        'logo', 'is_deleted', 'is_archived',
        'copied_count','notify_counter'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new CheckChannelNotDeletedScope());
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ChannelMember::class, 'channel_id', 'member_id')
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id'])
            ->where('channels_members.is_joined', YesOrNo::YES);
    }
// Channel.php
    public function creator(): belongsToMany
    {
        return $this->belongsToMany(User::class, ChannelMember::class, 'channel_id', 'member_id')
        ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id'])
        ->where('channels_members.member_group', ChannelGroup::ADMIN);
    }

    public function moderators(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ChannelMember::class, 'channel_id', 'member_id')
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id'])
            ->where('channels_members.member_group', ChannelGroup::MODERATOR);
    }

    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(User::class, ChannelMember::class, 'channel_id', 'member_id')
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id'])
            ->where('channels_members.member_group', ChannelGroup::GUEST);
    }

    public function communities(): HasMany
    {
        return $this->hasMany(Channel::class, 'parent_id')
            ->where('level', ChannelLevel::COMMUNITY);
    }

    public function subCommunities(): HasMany
    {
        return $this->hasMany(Channel::class, 'parent_id')
            ->where('level', ChannelLevel::SUBCOMMUNITY);
    }

    public function members(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'channel_id');
    }

    public function membersNotAdmins(): HasMany
    {
        return $this->hasMany(ChannelMember::class, 'channel_id')
            ->where('channels_members.member_group', '!=', ChannelGroup::ADMIN);
    }
}
