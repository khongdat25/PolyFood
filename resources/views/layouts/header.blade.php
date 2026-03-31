<!-- HEADER YOUTUBE STYLE -->
    <header class="header">
        <div class="header__left">
            <div class="menu-btn">☰</div>
            <a href="{{'/'}}" class="logo">
                Poly<span>Food</span>
            </a>
        </div>
        
        <div class="header__center">
            <!-- Chú thích: Sử dụng thẻ form để gửi dữ liệu tìm kiếm (từ khóa q) qua phương thức GET -->
            <form action="{{ route('search') }}" method="GET" class="search-box">
                <!-- Chú thích: Ô nhập liệu tìm kiếm, lưu lại giá trị cũ nếu người dùng vừa tìm -->
                <input type="text" name="q" placeholder="Tìm công thức hoặc video nấu ăn..." value="{{ request('q') }}">
                <button type="submit" class="search-btn">🔍</button>
            </form>
        </div>
        
        <div class="header__right">
            <i>🎥</i>
            <i>🛎️</i>
            <i>📺</i>
            <div class="avatar">P</div>
        </div>
    </header>
    <div class="main-layout">
        
        <!-- SIDEBAR TRÁI -->
        <aside class="sidebar">
            <div class="sidebar-item active"><i>🏠</i> Trang chủ</div>
            <div class="sidebar-item"><i>🔥</i> Bài viết</div>
            <div class="sidebar-item"><i>❤️</i> Đã thích</div>
            <div class="sidebar-item"><i>📜</i> Lịch sử xem</div>
        </aside>