<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'message',
        'from',
        'channel_id',
        'profile_image',
        'channel_image',
        'type',
        'username',
        'chat_user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
