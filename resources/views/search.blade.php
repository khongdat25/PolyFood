@extends('layouts.master')
@section('title', 'Tìm kiếm')
@section('page', 'search')
@section('content')
<div class="main-content">
        
        <!-- CHIPS -->
        <div class="chips">
            <!-- Chú thích: Khi nhấn vào danh mục sẽ gắn tham số tìm kiếm (q) lên URL để tiến hành lọc -->
            <!-- Dùng link route tới search kèm từ khoá tương ứng. Class active được bật khi đang hiển thị đúng thẻ đó. -->
            <a href="{{ route('search') }}" class="chip {{ empty($q) ? 'active' : '' }}">Tất cả</a>
            <a href="{{ route('search', ['q' => 'Món Việt']) }}" class="chip {{ $q === 'Món Việt' ? 'active' : '' }}">Món Việt</a>
            <a href="{{ route('search', ['q' => 'Món Âu']) }}" class="chip {{ $q === 'Món Âu' ? 'active' : '' }}">Món Âu</a>
            <a href="{{ route('search', ['q' => 'Ăn vặt']) }}" class="chip {{ $q === 'Ăn vặt' ? 'active' : '' }}">Ăn vặt</a>
            <a href="{{ route('search', ['q' => 'Healthy']) }}" class="chip {{ $q === 'Healthy' ? 'active' : '' }}">Healthy</a>
            <a href="{{ route('search', ['q' => 'chay']) }}" class="chip {{ strtolower($q) === 'chay' ? 'active' : '' }}">Chay ngon</a>
            <a href="{{ route('search', ['q' => 'nước chấm']) }}" class="chip {{ strtolower($q) === 'nước chấm' ? 'active' : '' }}">Nước chấm</a>
            <a href="{{ route('search', ['q' => 'BBQ']) }}" class="chip {{ strtoupper($q) === 'BBQ' ? 'active' : '' }}">BBQ</a>
            <a href="{{ route('search', ['q' => 'Mới nhất']) }}" class="chip {{ $q === 'Mới nhất' ? 'active' : '' }}">Mới nhất</a>
            <a href="{{ route('search', ['q' => 'Xu hướng']) }}" class="chip {{ $q === 'Xu hướng' ? 'active' : '' }}">Xu hướng</a>
        </div>
        <!-- KẾT QUẢ TÌM KIẾM -->
        <!-- Chú thích: Hiển thị tiêu đề kết quả dựa trên từ khóa người dùng nhập -->
        <div class="section-title">📺 Kết quả tìm kiếm cho: "{{ $q }}"</div>
        <div class="video-grid">
            @if(isset($videos) && $videos->count() > 0)
                <!-- Chú thích: Vòng lặp foreach duyệt qua từng bản ghi video lấy ra từ cơ sở dữ liệu -->
                @foreach($videos as $video)
                <div class="video-card" style="position:relative;">
                    <a href="{{ route('videos.show', $video->id) }}" style="text-decoration:none; color:inherit; display:block;">
                        <div class="thumbnail">
                            @if($video->thumbnail && !Str::startsWith($video->thumbnail, ['http', 'https']))
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}">
                            @else
                                <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
                            @endif
                            <span class="duration">{{ $video->duration ?? '10:00' }}</span>
                        </div>
                    </a>
                    <div class="video-info" style="display:flex; justify-content:space-between; align-items:flex-start;">
                        <div style="display:flex; gap:12px; width:100%;">
                            @if($video->user && $video->user->avatar)
                                <div class="channel-avatar" style="background-image: url('{{ asset('storage/' . $video->user->avatar) }}'); background-size: cover; cursor:pointer;" onclick="location.href='{{ route('channel', $video->user->id ?? 1) }}'"></div>
                            @else
                                <div class="channel-avatar" style="cursor:pointer;" onclick="location.href='{{ route('channel', $video->user->id ?? 1) }}'">{{ substr($video->user->name ?? 'P', 0, 1) }}</div>
                            @endif
                            <div class="video-details" style="flex:1;">
                                <a href="{{ route('videos.show', $video->id) }}" style="text-decoration:none; color:inherit;">
                                    <h3 style="margin-bottom:4px; margin-right:20px;">{{ $video->title }}</h3>
                                </a>
                                <p style="cursor:pointer;" onclick="location.href='{{ route('channel', $video->user->id ?? 1) }}'">{{ $video->user->name ?? 'PolyFood' }}</p>
                                <p>{{ number_format($video->views ?? 0) }} lượt xem</p>
                                @if($video->create_at)
                                    <p style="font-size: 12px; color: #aaa; margin-top: 2px;">{{ \Carbon\Carbon::parse($video->create_at)->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- 3-Dot Menu Actions (Search) --}}
                        <div style="position:relative; margin-top:4px;" class="video-menu-container">
                            <button class="menu-trigger" 
                               style="background:transparent;color:#fff;border:none;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;opacity:0;transition:opacity 0.2s;"
                               onclick="toggleMenu(event, 'menu-search-{{ $video->id }}')" title="Tùy chọn">
                                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M12 16.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zM10.5 12c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5zm0-6c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5z"></path></svg>
                            </button>
                            
                            {{-- Dropdown Menu --}}
                            <div id="menu-search-{{ $video->id }}" class="dropdown-menu" 
                                 style="display:none;position:absolute;top:36px;right:0;background:#272727;border-radius:12px;padding:8px;box-shadow:0 8px 24px rgba(0,0,0,0.8);min-width:160px;z-index:100;">
                                
                                {{-- Edit/Delete chỉ hiện nếu là video của mình đăng --}}
                                @if(Auth::check() && $video->user_id === Auth::id())
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
            @else
                <!-- Chú thích: Nếu không tìm thấy kết quả nào thì sẽ hiển thị thông báo này -->
                <div style="grid-column: 1 / -1; padding: 20px; text-align: center; color: #888;">
                    <p>Không tìm thấy video nào phù hợp với từ khóa "{{ $q }}".</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.video-card:hover .menu-trigger { opacity: 1 !important; transform: translateY(-4px); }
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