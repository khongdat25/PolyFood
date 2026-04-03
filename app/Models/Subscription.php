<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id',
        'channel_id',
    ];

    /**
     * Người đăng ký
     */
    public function subscriber()
    {
        return $this->belongsTo(User::class, 'subscriber_id');
    }

    /**
     * Kênh được đăng ký
     */
    public function channel()
    {
        return $this->belongsTo(User::class, 'channel_id');
    }
}
