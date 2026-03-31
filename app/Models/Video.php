<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Chỉ định rõ tên bảng vì Laravel mặc định tìm bảng số nhiều (videos)
    protected $table = 'video';

    public $timestamps = false; // nếu bảng không có created_at, updated_at
   
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
}
