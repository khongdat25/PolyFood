<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Thêm dòng này để cho phép lưu tên, slug, icon và status
    protected $fillable = ['name', 'slug', 'icon', 'status'];

    public function videos() {
        return $this->hasMany(Video::class);
    }
}
