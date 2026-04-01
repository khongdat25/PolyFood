@extends('layouts.master')

@section('title', $user->name . ' - Kênh của tôi')
@section('page', 'profile')

@section('content')
<style>
    /* Ẩn sidebar + mở rộng khu vực content cho trang profile */
    .profile-page .sidebar { display: none !important; }
    .profile-page .main-layout { display: block !important; }
</style>
<script>document.body.classList.add('profile-page');</script>
<div style="background:#0f0f0f; min-height:calc(100vh - 64px); color:#fff; padding-bottom:60px; width:100%;">

    {{-- Flash messages --}}
    @if(session('success'))
    <div style="background:#16a34a;color:#fff;padding:12px 24px;text-align:center;font-size:14px;">
        ✅ {{ session('success') }}
    </div>
    @endif

    {{-- ===== COVER IMAGE ===== --}}
    <div class="cover-image" style="height:220px; position:relative;">
        {{-- Avatar upload form (hidden, triggered by click) --}}
        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
            @csrf
            <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display:none;"
                   onchange="this.form.submit()">
        </form>
    </div>

    {{-- ===== PROFILE INFO CARD ===== --}}
    <div style="max-width:1400px; margin:0 auto; padding:0 24px; position:relative; z-index:10; margin-top:-60px;">
        <div style="background:#1c1c1c; border-radius:20px; padding:24px 28px; display:flex; flex-wrap:wrap; align-items:flex-end; gap:20px; box-shadow:0 20px 40px rgba(0,0,0,0.5);">

            {{-- Avatar --}}
            <div style="margin-top:-60px; flex-shrink:0; position:relative;">
                <div style="width:120px;height:120px;border-radius:16px;overflow:hidden;border:4px solid #1c1c1c;box-shadow:0 4px 20px rgba(0,0,0,0.5); {{ Auth::check() && Auth::id() === $user->id ? 'cursor:pointer;' : '' }}"
                     @if(Auth::check() && Auth::id() === $user->id) onclick="document.getElementById('avatarInput').click()" title="Nhấn để thay ảnh đại diện" @endif>
                    @if($user->avatar)
                        <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar"
                             style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <div style="width:100%;height:100%;background:linear-gradient(135deg,#f97316,#dc2626);display:flex;align-items:center;justify-content:center;font-size:48px;font-weight:700;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                @if(Auth::check() && Auth::id() === $user->id)
                <div style="position:absolute;bottom:4px;right:4px;background:#f97316;border-radius:50%;width:24px;height:24px;display:flex;align-items:center;justify-content:center;font-size:12px;cursor:pointer;"
                     onclick="document.getElementById('avatarInput').click()" title="Đổi ảnh">
                    ✏️
                </div>
                @endif
            </div>

            {{-- Channel info --}}
            <div style="flex:1; min-width:0; padding-top:8px;">
                <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;">
                    <div>
                        <h1 style="font-size:28px;font-weight:700;margin:0;">{{ $user->name }}</h1>
                        <div style="color:#aaa;margin-top:4px;font-size:14px;">
                            {{ '@' . strtolower(str_replace(' ','_',$user->name)) }}
                        </div>
                        <div style="display:flex;gap:24px;margin-top:10px;font-size:13px;color:#aaa;">
                            <span>👤 <strong style="color:#fff;">{{ number_format($totalVideos) }}</strong> video</span>
                            <span>👁️ <strong style="color:#fff;">{{ number_format($totalViews) }}</strong> lượt xem</span>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    @if(Auth::check() && Auth::id() === $user->id)
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        <a href="{{ route('videos.create') }}"
                           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#f97316;color:#fff;border-radius:14px;font-weight:600;font-size:14px;text-decoration:none;transition:0.2s;"
                           onmouseover="this.style.background='#ea6c00'" onmouseout="this.style.background='#f97316'">
                            🎬 Đăng video
                        </a>
                        <a href="{{ route('profile.edit') }}"
                           style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#2a2a2a;color:#ddd;border-radius:14px;font-weight:600;font-size:14px;text-decoration:none;transition:0.2s;"
                           onmouseover="this.style.background='#3a3a3a'" onmouseout="this.style.background='#2a2a2a'">
                            ⚙️ Cài đặt
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===== NAV TABS ===== --}}
    <div style="max-width:1400px;margin:0 auto;padding:0 24px;margin-top:28px;border-bottom:1px solid #2a2a2a;">
        <div style="display:flex;gap:8px;overflow-x:auto;padding-bottom:2px;">
            <a href="#" class="nav-tab active"
               style="color:#f97316;padding:12px 16px;font-weight:600;font-size:14px;white-space:nowrap;text-decoration:none;position:relative;">
                🎬 Video {{ Auth::check() && Auth::id() === $user->id ? 'của tôi' : 'của ' . $user->name }}
            </a>
        </div>
    </div>

    {{-- ===== VIDEO GRID ===== --}}
    <div style="max-width:1400px;margin:0 auto;padding:24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-size:20px;font-weight:600;margin:0;">Tất cả video <span style="color:#aaa;font-size:14px;font-weight:400;">({{ $totalVideos }})</span></h2>
        </div>

        @if($videos->isEmpty())
        <div style="text-align:center;padding:80px 0;color:#aaa;">
            <div style="font-size:64px;margin-bottom:16px;">🎬</div>
            <p style="font-size:18px;margin:0;">Bạn chưa có video nào.</p>
            <a href="{{ route('videos.create') }}" style="display:inline-block;margin-top:16px;padding:12px 28px;background:#f97316;color:#fff;border-radius:14px;font-weight:600;text-decoration:none;">
                Đăng video đầu tiên
            </a>
        </div>
        @else
        <div class="profile-video-grid">
            @foreach($videos as $video)
            <div class="video-card" style="background:#1c1c1c;border-radius:14px;position:relative;">

                {{-- Thumbnail --}}
                <div class="thumbnail-container" style="position:relative;overflow:hidden;border-radius:14px 14px 0 0;">
                    <a href="{{ route('videos.show', $video->id) }}" style="display:block;">
                        @if($video->thumbnail && !Str::startsWith($video->thumbnail, ['http', 'https']))
                            <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}"
                                 style="width:100%;aspect-ratio:16/9;object-fit:cover;transition:transform 0.3s;display:block;">
                        @elseif($video->thumbnail)
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}"
                                 style="width:100%;aspect-ratio:16/9;object-fit:cover;transition:transform 0.3s;display:block;">
                        @else
                            <div style="width:100%;aspect-ratio:16/9;background:linear-gradient(135deg,#1e1e2e,#2d1b4e);display:flex;align-items:center;justify-content:center;font-size:40px;">
                                🎬
                            </div>
                        @endif
                    </a>
                </div> <!-- Đóng .thumbnail-container -->

                <div style="padding:12px; display:flex; justify-content:space-between; align-items:flex-start; gap:8px;">
                    <div style="flex:1;">
                        <a href="{{ route('videos.show', $video->id) }}" style="text-decoration:none; color:inherit;">
                            <h3 style="font-size:14px;font-weight:600;margin:0 0 6px;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $video->title }}
                            </h3>
                        </a>
                        <div style="font-size:12px;color:#aaa;">
                            👁️ {{ number_format($video->views ?? 0) }} lượt xem
                            <span style="margin:0 6px;">•</span>
                            {{ $video->create_at ? \Carbon\Carbon::parse($video->create_at)->format('d/m/Y H:i') : 'Vừa đăng' }}
                        </div>
                    </div>

                    {{-- 3-Dot Menu Actions --}}
                    <div style="position:relative; margin-top:-4px;" class="video-menu-container">
                        <button class="menu-trigger" 
                           style="background:transparent;color:#fff;border:none;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;opacity:0;transition:opacity 0.2s;"
                           onclick="toggleMenu(event, 'menu-{{ $video->id }}')" title="Tùy chọn">
                            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 16.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zM10.5 12c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5zm0-6c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5z"></path></svg>
                        </button>
                        
                        {{-- Dropdown Menu --}}
                        <div id="menu-{{ $video->id }}" class="dropdown-menu" 
                             style="display:none;position:absolute;top:32px;right:0;background:#272727;border-radius:12px;padding:8px;box-shadow:0 8px 24px rgba(0,0,0,0.8);min-width:160px;z-index:100;">
                            
                            @if($video->user_id === Auth::id())
                                <a href="{{ route('videos.edit', $video->id) }}" 
                                   style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;transition:0.2s;"
                                   onmouseover="this.style.background='#3f3f3f'" onmouseout="this.style.background='transparent'">
                                    ✏️ Chỉnh sửa
                                </a>
                                
                                <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Xóa video này?')" style="margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            style="display:flex;align-items:center;gap:12px;width:100%;text-align:left;padding:10px 12px;background:transparent;color:#f87171;border:none;border-radius:8px;font-size:14px;cursor:pointer;transition:0.2s;"
                                            onmouseover="this.style.background='#3f3f3f'" onmouseout="this.style.background='transparent'">
                                        🗑️ Xóa
                                    </button>
                                </form>
                            @endif
                            
                            <a href="#" onclick="event.preventDefault(); alert('Chức năng Chia sẻ sẽ sớm ra mắt!');"
                               style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;transition:0.2s;"
                               onmouseover="this.style.background='#3f3f3f'" onmouseout="this.style.background='transparent'">
                                ↗️ Chia sẻ
                            </a>
                            <a href="#" onclick="event.preventDefault(); alert('Chức năng Tải xuống sẽ sớm ra mắt!');"
                               style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;transition:0.2s;"
                               onmouseover="this.style.background='#3f3f3f'" onmouseout="this.style.background='transparent'">
                                ⬇️ Tải xuống
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($videos->hasPages())
        <div style="margin-top:32px;display:flex;justify-content:center;">
            {{ $videos->links() }}
        </div>
        @endif
        @endif
    </div>

</div>
</div>{{-- đóng .main-layout --}}

<style>
.profile-video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 20px;
}
.video-card:hover .menu-trigger { opacity: 1 !important; }
.video-card { transition: transform 0.3s; position: relative; }
</style>
<script>
// Toggle menu
function toggleMenu(e, menuId) {
    e.preventDefault();
    e.stopPropagation();
    
    const menu = document.getElementById(menuId);
    
    // Close other menus
    document.querySelectorAll('.dropdown-menu').forEach(m => {
        if (m.id !== menuId) m.style.display = 'none';
    });
    
    // Toggle current
    if (menu.style.display === 'none') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}

// Close menu when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.video-menu-container')) {
        document.querySelectorAll('.dropdown-menu').forEach(m => {
            m.style.display = 'none';
        });
    }
});
</script>
@endsection
