<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'video_url',
        'thumbnail',
        'description',
        'user_id',
        'category_id',
        'create_at',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
