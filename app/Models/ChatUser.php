<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $table = 'chat_users';

    protected $fillable = [
        'who_start_chat', 'who_receive_message','notify_counter','counter'
    ];
}
