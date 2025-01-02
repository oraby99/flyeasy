<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\ActivationStatus;
use App\Enums\ChannelLevel;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'status', 'verification_code',
        'email_verified_at', 'group', 'profile_image',
        'default_lang', 'discount', 'device_token','country_code','work_id','company'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function isVerified(): bool
    {
        return $this->email_verified_at != null;
    }

    public function isActive(): bool
    {
        return $this->status === ActivationStatus::ACTIVE;
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, ChannelMember::class, 'member_id', 'channel_id')
            ->where('channels.level', ChannelLevel::TEAM)
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id']);
    }

    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, ChannelMember::class, 'member_id', 'channel_id')
            ->where('channels.level', ChannelLevel::COMMUNITY)
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id']);
    }

    public function subCommunities(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, ChannelMember::class, 'member_id', 'channel_id')
            ->where('channels.level', ChannelLevel::SUBCOMMUNITY)
            ->withPivot(['member_group', 'channel_level', 'is_joined', 'team_id']);
    }

    public function subscription(): hasOne
    {
        return $this->hasOne(Subscription::class);
    }
}
