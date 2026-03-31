<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chèn 5 video mẫu vào bảng `video` để có dữ liệu thử nghiệm tìm kiếm
        DB::table('video')->insert([
            [
                'title' => 'Cách làm nem chay giòn rụm chỉ 15 phút',
                'video_url' => 'https://www.youtube.com/watch?v=12345',
                'thumbnail' => 'https://picsum.photos/id/200/600/400',
                'description' => 'Hướng dẫn chi tiết cách làm nem chay siêu giòn rụm tại nhà.',
                'user_id' => 1,
                'category_id' => 1,
                'create_at' => now(),
                'views' => 1500,
            ],
            [
                'title' => 'Gỏi cuốn chay tươi ngon ngày hè',
                'video_url' => 'https://www.youtube.com/watch?v=67890',
                'thumbnail' => 'https://picsum.photos/id/201/600/400',
                'description' => 'Món gỏi cuốn thuần chay bổ dưỡng, giải nhiệt rất tốt.',
                'user_id' => 1,
                'category_id' => 1,
                'create_at' => now(),
                'views' => 2400,
            ],
            [
                'title' => '3 công thức nước chấm BBQ cực ngon',
                'video_url' => 'https://www.youtube.com/watch?v=abcd1',
                'thumbnail' => 'https://picsum.photos/id/160/600/400',
                'description' => 'Bí quyết pha nước chấm nướng BBQ đậm đà, dễ làm.',
                'user_id' => 2,
                'category_id' => 2,
                'create_at' => now(),
                'views' => 3100,
            ],
            [
                'title' => 'Luộc rau củ giữ nguyên vitamin và độ ngọt',
                'video_url' => 'https://www.youtube.com/watch?v=abcd2',
                'thumbnail' => 'https://picsum.photos/id/202/600/400',
                'description' => 'Cách luộc rau xanh mướt, giữ độ giòn và dưỡng chất tốt nhất.',
                'user_id' => 1,
                'category_id' => 3,
                'create_at' => now(),
                'views' => 800,
            ],
            [
                'title' => 'Bánh cuốn nấm chay siêu mềm và nhanh',
                'video_url' => 'https://www.youtube.com/watch?v=abcd3',
                'thumbnail' => 'https://picsum.photos/id/251/600/400',
                'description' => 'Làm bánh cuốn nóng tại nhà chỉ với chảo cực kì đơn giản.',
                'user_id' => 2,
                'category_id' => 1,
                'create_at' => now(),
                'views' => 1950,
            ]
        ]);
    }
}
