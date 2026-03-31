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
                <div class="video-card">
                    <div class="thumbnail">
                        <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
                        <span class="duration">{{ $video->duration ?? '10:00' }}</span>
                    </div>
                    <div class="video-info">
                        <!-- Chú thích: Hiển thị avatar mặc định P (PolyFood) -->
                        <div class="channel-avatar">P</div>
                        <div class="video-details">
                            <!-- Chú thích: Tiêu đề video (title) -->
                            <h3>{{ $video->title }}</h3>
                            <!-- Chú thích: Số lượt xem (views) -->
                            <p>PolyFood • {{ number_format($video->views) }} lượt xem</p>
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
    @endsection