<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'body'
    ];

    public function user() {
        $this->belongsTo('App\User');
    }
}
