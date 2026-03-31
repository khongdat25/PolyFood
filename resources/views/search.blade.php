@extends('layouts.master')
@section('title', 'Tìm kiếm')
@section('page', 'search')
@section('content')
<div class="main-content">
        
        <!-- CHIPS -->
        <div class="chips">
            <div class="chip active">Tất cả</div>
            <div class="chip">Món Việt</div>
            <div class="chip">Món Âu</div>
            <div class="chip">Ăn vặt</div>
            <div class="chip">Healthy</div>
            <div class="chip">Chay ngon</div>
            <div class="chip">Nước chấm</div>
            <div class="chip">BBQ</div>
            <div class="chip">Mới nhất</div>
            <div class="chip">Xu hướng</div>
        </div>
        <!-- TRENDING -->
        <div class="section-title">🔥 Đang thịnh hành hôm nay</div>
        <div class="video-grid">
            <div class="video-card">
                <div class="thumbnail"><img src="c" alt=""><span class="duration">12:45</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Cách làm nem chay giòn rụm chỉ 15 phút - HOT</h3>
                        <p>PolyFood • 2.4M lượt xem • 3 giờ trước</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/201/600/400" alt=""><span class="duration">08:20</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Gỏi cuốn chay tươi ngon - 1 triệu view chỉ trong 1 ngày</h3>
                        <p>PolyFood • 1.8M lượt xem • 5 giờ trước</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/251/600/400" alt=""><span class="duration">18:30</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Bánh cuốn chay tại nhà siêu dễ - Xu hướng tuần này</h3>
                        <p>PolyFood • 1.1M lượt xem • 12 giờ trước</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/160/600/400" alt=""><span class="duration">22:10</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>3 công thức nước chấm BBQ đậm đà nhất 2026</h3>
                        <p>PolyFood • 980K lượt xem • 1 ngày trước</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- KHÁM PHÁ THEO DANH MỤC -->
        <div class="section-title">🌟 Khám phá theo danh mục</div>
        <div class="video-grid">
            <!-- 4 cards đầu -->
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/29/600/400" alt=""><span class="duration">15:20</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Món Việt Nam truyền thống</h3>
                        <p>324 video</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/201/600/400" alt=""><span class="duration">10:05</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Món Âu hiện đại</h3>
                        <p>187 video</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/251/600/400" alt=""><span class="duration">09:40</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Ăn vặt siêu ngon</h3>
                        <p>412 video</p>
                    </div>
                </div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/160/600/400" alt=""><span class="duration">11:50</span></div>
                <div class="video-info">
                    <div class="channel-avatar">P</div>
                    <div class="video-details">
                        <h3>Healthy &amp; Low Carb</h3>
                        <p>256 video</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- TẤT CẢ VIDEO MỚI -->
        <div class="section-title">📺 Tất cả video mới nhất</div>
        <div class="video-grid">
            <!-- 8 cards (tự xuống hàng 4) -->
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/29/600/400" alt=""><span class="duration">14:55</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Cá trê chiên xù giòn tan</h3><p>PolyFood • 723K lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/201/600/400" alt=""><span class="duration">09:40</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Luộc rau củ giữ dinh dưỡng</h3><p>PolyFood • 412K lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/251/600/400" alt=""><span class="duration">25:15</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Nước chấm phở chuẩn vị Hà Nội</h3><p>PolyFood • 2.1M lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/160/600/400" alt=""><span class="duration">11:05</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Bánh mì kẹp thịt nướng</h3><p>PolyFood • 987K lượt xem</p></div></div>
            </div>
            <!-- Thêm 4 card nữa -->
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/29/600/400" alt=""><span class="duration">07:30</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Salad rau củ healthy 10 phút</h3><p>PolyFood • 541K lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/201/600/400" alt=""><span class="duration">16:45</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Cách làm vịt quay Bắc Kinh</h3><p>PolyFood • 1.3M lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/251/600/400" alt=""><span class="duration">13:20</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Phở bò Hà Nội chuẩn vị</h3><p>PolyFood • 3.2M lượt xem</p></div></div>
            </div>
            <div class="video-card">
                <div class="thumbnail"><img src="https://picsum.photos/id/160/600/400" alt=""><span class="duration">10:10</span></div>
                <div class="video-info"><div class="channel-avatar">P</div><div class="video-details"><h3>Bánh mì que kẹp thịt nướng</h3><p>PolyFood • 678K lượt xem</p></div></div>
            </div>
        </div>
    </div>
</div>
    @endsection