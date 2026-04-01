@extends('layouts.master')

@section('title', 'Chỉnh sửa video')
@section('page', 'profile')

@section('content')
<style>
    .profile-page .sidebar { display: none !important; }
</style>
<script>document.body.classList.add('profile-page');</script>
<div style="background:#0f0f0f; min-height:calc(100vh - 64px); color:#fff; padding:40px 16px; flex:1;">
    <div style="max-width:680px; margin:0 auto;">

        <div style="margin-bottom:28px;">
            <a href="{{ route('profile') }}" style="color:#aaa;text-decoration:none;font-size:13px;">
                ← Quay lại kênh của tôi
            </a>
            <h1 style="font-size:26px;font-weight:700;margin:10px 0 0;">✏️ Chỉnh sửa video</h1>
        </div>

        @if($errors->any())
        <div style="background:#7f1d1d;border-radius:12px;padding:16px;margin-bottom:20px;font-size:14px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data"
              style="background:#1c1c1c;border-radius:20px;padding:32px;display:flex;flex-direction:column;gap:22px;">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label style="display:block;font-weight:600;font-size:14px;margin-bottom:8px;">
                    Tiêu đề <span style="color:#f97316;">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $video->title) }}" required
                       style="width:100%;padding:12px 16px;background:#272727;border:1px solid #3a3a3a;border-radius:10px;color:#fff;font-size:14px;box-sizing:border-box;outline:none;"
                       onfocus="this.style.borderColor='#f97316'" onblur="this.style.borderColor='#3a3a3a'">
            </div>

            {{-- Description --}}
            <div>
                <label style="display:block;font-weight:600;font-size:14px;margin-bottom:8px;">Mô tả</label>
                <textarea name="description" rows="4"
                          style="width:100%;padding:12px 16px;background:#272727;border:1px solid #3a3a3a;border-radius:10px;color:#fff;font-size:14px;box-sizing:border-box;resize:vertical;outline:none;"
                          onfocus="this.style.borderColor='#f97316'" onblur="this.style.borderColor='#3a3a3a'">{{ old('description', $video->description) }}</textarea>
            </div>

            {{-- Current video info --}}
            <div style="background:#272727;border-radius:10px;padding:14px;font-size:13px;color:#aaa;">
                🎬 File video hiện tại: <span style="color:#f97316;">{{ basename($video->video_url ?? 'Chưa có') }}</span>
                <br><small>Không thể thay thế file video. Nếu cần, hãy xóa và đăng lại.</small>
            </div>

            {{-- Thumbnail --}}
            <div>
                <label style="display:block;font-weight:600;font-size:14px;margin-bottom:8px;">
                    Ảnh thumbnail
                    <span style="font-weight:400;color:#aaa;">(để trống để giữ ảnh cũ)</span>
                </label>
                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                    <label style="cursor:pointer;">
                        <div id="thumbPreview" style="width:160px;height:90px;background:#272727;border-radius:10px;border:2px dashed #3a3a3a;overflow:hidden;">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/'.$video->thumbnail) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:28px;">🖼️</div>
                            @endif
                        </div>
                        <input type="file" name="thumbnail" accept="image/*" style="display:none;"
                               onchange="previewThumb(this)">
                    </label>
                    <span style="font-size:13px;color:#aaa;">Nhấn vào hình để thay thumbnail mới</span>
                </div>
            </div>

            {{-- Submit --}}
            <div style="display:flex;gap:12px;margin-top:8px;">
                <button type="submit"
                        style="flex:1;padding:14px;background:#f97316;color:#fff;border:none;border-radius:12px;font-size:16px;font-weight:700;cursor:pointer;transition:0.2s;"
                        onmouseover="this.style.background='#ea6c00'" onmouseout="this.style.background='#f97316'">
                    💾 Lưu thay đổi
                </button>
                <a href="{{ route('profile') }}"
                   style="padding:14px 24px;background:#272727;color:#ddd;border-radius:12px;font-size:16px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">
                    Huỷ
                </a>
            </div>
        </form>
    </div>
</div>
</div>{{-- đóng .main-layout --}}

<script>
function previewThumb(input) {
    const preview = document.getElementById('thumbPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
            preview.style.border = '2px solid #f97316';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
