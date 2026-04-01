<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'video';
    public $timestamps = false;

=======
    // Chỉ định rõ tên bảng vì Laravel mặc định tìm bảng số nhiều (videos)
    protected $table = 'video';

    public $timestamps = false; // nếu bảng không có created_at, updated_at
   
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133
    protected $fillable = [
        'title',
        'video_url',
        'thumbnail',
        'description',
        'user_id',
        'category_id',
<<<<<<< HEAD
        'create_at',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
=======
        'create_at',   
        'views',
    ];
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133
}
