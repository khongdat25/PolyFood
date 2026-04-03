<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Helpers\VideoHelper;
use Carbon\Carbon;
use App\Notifications\NewVideoNotification;
use Illuminate\Support\Facades\Notification;

class VideoController extends Controller
{
    /**
     * Trang profile: hiển thị video của người dùng đang đăng nhập
     */
    public function index()
    {
        $user   = Auth::user();
        $videos = Video::where('user_id', $user->id)
                       ->orderByDesc('id')
                       ->paginate(12);

        $totalViews = Video::where('user_id', $user->id)->sum('views');
        $totalVideos = Video::where('user_id', $user->id)->count();

        return view('profile.index', compact('user', 'videos', 'totalViews', 'totalVideos'));
    }

    /**
     * Trang xem video
     */
    public function show(Video $video)
    {
        // Tăng lượt xem
        $video->increment('views');

        // Lấy video liên quan (cùng danh mục, loại trừ video hiện tại)
        $relatedVideos = Video::with('user')
            ->where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->limit(10)
            ->get();

        // Xử lý duration và time_ago cho video liên quan
        foreach ($relatedVideos as $v) {
            // Giả định video_url là đường dẫn trong storage/public
            $fullPath = public_path('storage/' . $v->video_url);
            if (file_exists($fullPath)) {
                $v->duration = VideoHelper::getDurationFromUrl($fullPath);
            }
            $v->time_ago = $v->create_at ? Carbon::parse($v->create_at)->diffForHumans() : '';
        }

        // Tải thêm quan hệ cho video hiện tại
        $video->load('user', 'category');

        return view('videos.show', compact('video', 'relatedVideos'));
    }

    /**
     * Trang profile công khai của một người dùng bất kỳ (kênh)
     */
    public function channel($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $videos = Video::with('user')->where('user_id', $user->id)
                       ->orderByDesc('id')
                       ->paginate(12);

        $totalViews = Video::where('user_id', $user->id)->sum('views');
        $totalVideos = Video::where('user_id', $user->id)->count();

        // Tái sử dụng giao diện profile.index nhưng truyền vào user chủ kênh
        return view('profile.index', compact('user', 'videos', 'totalViews', 'totalVideos'));
    }

    /**
     * Form đăng video mới
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Lưu video mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file'  => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:204800',
            'thumbnail'   => 'nullable|image|max:5120',
        ], [
            'title.required'      => 'Tiêu đề không được để trống.',
            'video_file.required' => 'Vui lòng chọn file video.',
            'video_file.mimetypes'=> 'File video phải là định dạng MP4, MOV hoặc AVI.',
            'video_file.max'      => 'File video không được vượt quá 200MB.',
            'thumbnail.image'     => 'Ảnh thumbnail phải là file ảnh.',
            'thumbnail.max'       => 'Ảnh thumbnail không được vượt quá 5MB.',
        ]);

        // Lưu file video
        $videoPath = $request->file('video_file')->store('videos', 'public');

        // Lưu thumbnail (nếu có)
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $video = Video::create([
            'title'       => $request->title,
            'description' => $request->description,
            'video_url'   => $videoPath,
            'thumbnail'   => $thumbnailPath,
            'user_id'     => Auth::id(),
            'category_id' => 1, // Default category
            'create_at'   => now()->format('Y-m-d H:i:s'),
            'views'       => 0,
        ]);

        // Thông báo cho tất cả người đăng ký
        $user = Auth::user();
        if ($user->subscribers()->count() > 0) {
            Notification::send($user->subscribers, new NewVideoNotification($video));
        }

        return redirect()->route('profile')->with('success', 'Video đã được đăng thành công!');
    }

    /**
     * Form chỉnh sửa video
     */
    public function edit(Video $video)
    {
        // Chỉ cho phép chủ video sửa
        if ($video->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền chỉnh sửa video này.');
        }
        return view('videos.edit', compact('video'));
    }

    /**
     * Cập nhật thông tin video
     */
    public function update(Request $request, Video $video)
    {
        if ($video->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail'   => 'nullable|image|max:5120',
        ]);

        // Thay thumbnail nếu có upload mới
        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $video->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $video->title       = $request->title;
        $video->description = $request->description;
        $video->save();

        return redirect()->route('profile')->with('success', 'Đã cập nhật video thành công!');
    }

    /**
     * Xóa video
     */
    public function destroy(Video $video)
    {
        if ($video->user_id !== Auth::id()) {
            abort(403);
        }

        // Xóa file vật lý
        if ($video->video_url) {
            Storage::disk('public')->delete($video->video_url);
        }
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        $video->delete();

        return redirect()->route('profile')->with('success', 'Đã xóa video.');
    }

    /**
     * Cập nhật avatar người dùng
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return redirect()->route('profile')->with('success', 'Đã cập nhật ảnh đại diện!');
    }
}
