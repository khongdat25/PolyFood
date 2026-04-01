<?php

namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Helpers\VideoHelper;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    function index(){
<<<<<<< HEAD
        $video= Video::with('user')->orderBy('id', 'desc')->get();
=======
        $video= Video::all();
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133
        foreach ($video as $v) {
            $v->duration = VideoHelper::getDurationFromUrl($v->video_url);
        }
        return view('home', compact('video'));
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
<<<<<<< HEAD
        $videos = Video::with('user')->where('title', 'like', "%{$q}%")->orderBy('id', 'desc')->get();
=======
        $videos = Video::where('title', 'like', "%{$q}%")->get();
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133

        // 3. Xử lý tính toán thời lượng video cho từng kết quả tìm được
        foreach ($videos as $v) {
            $v->duration = VideoHelper::getDurationFromUrl($v->video_url);
        }

        // 4. Trả kết quả về giao diện tìm kiếm (view)
        return view('search', compact('videos', 'q'));
    }
}
