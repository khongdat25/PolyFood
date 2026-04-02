<?php

namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use Carbon\Carbon;
use App\Helpers\VideoHelper;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    function index(){
        $new= Video::orderBy('create_at', 'desc')->limit(5)->get();
        $video= Video::inRandomOrder()->get();
        $videoByCate = Video::with('user', 'category')->get();
        $category = Category::all();
        foreach ($video as $v) {
            $v->duration = VideoHelper::getDuration($v->video_url);
             $v->time_ago = Carbon::parse($v->create_at)->diffForHumans();
        }
         foreach ($new as $v) {
        $v->duration = VideoHelper::getDuration($v->video_url);
        $v->time_ago = Carbon::parse($v->create_at)->diffForHumans();
    }
        return view('home', compact('video', 'category', 'new', 'videoByCate'));
    }

    /**
     * Hàm xử lý tìm kiếm video
     * Yêu cầu: "Chức năng tìm kiếm theo tên cho web để cả chú thích dễ nhận biết"
     * @param Request $request đối tượng chứa dữ liệu người dùng gửi lên URL
     */
    public function search(Request $request) {
        // 1. Lấy từ khóa tìm kiếm (q) từ URL: /search?q=từ_khóa
        $q = $request->input('q');

        // 2. Tìm kiếm trong bảng video với điều kiện tiêu đề giống với từ khóa

        $videos = Video::with('user')->where('title', 'like', "%{$q}%")->orderBy('id', 'desc')->get();

        $videos = Video::where('title', 'like', "%{$q}%")->get();
        // 3. Xử lý tính toán thời lượng video cho từng kết quả tìm được
        foreach ($videos as $v) {
            $v->duration = VideoHelper::getDuration($v->video_url);
        }

        // 4. Trả kết quả về giao diện tìm kiếm (view)
        return view('search', compact('videos', 'q'));
    }
}
