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
            @auth
            <div class="user-menu-container" style="position: relative;">
                <!-- Avatar hiển thị chữ cái đầu của tên -->
                <div class="avatar" onclick="document.getElementById('user-dropdown').classList.toggle('show')" style="cursor: pointer;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                
                <!-- Dropdown Menu -->
                <div id="user-dropdown" class="user-dropdown-menu" style="display: none; position: absolute; right: 0; top: 120%; background: #272727; border: 1px solid #3f3f3f; border-radius: 12px; width: 220px; padding: 10px 0; z-index: 1000; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);">
                    <div style="padding: 10px 20px; border-bottom: 1px solid #3f3f3f; margin-bottom: 5px;">
                        <p style="margin: 0; color: #fff; font-weight: bold; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</p>
                        <p style="margin: 0; color: #aaa; font-size: 13px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->email }}</p>
                    </div>
                    

                    <a href="{{ route('profile') }}" style="display: block; padding: 10px 20px; color: #ddd; text-decoration: none; font-size: 14px; transition: 0.2s;" onmouseover="this.style.background='#3f3f3f'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#ddd'">

                        👤 Hồ sơ cá nhân
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" style="width: 100%; text-align: left; background: none; border: none; padding: 10px 20px; color: #ddd; font-size: 14px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#3f3f3f'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#ddd'">
                            🚪 Đăng xuất
                        </button>
                    </form>
                </div>
            </div>

            <style>
                .user-dropdown-menu.show { display: block !important; }
            </style>
            <script>
                // Đóng menu nếu click ra ngoài vùng avatar
                document.addEventListener('click', function(event) {
                    var avatar = document.querySelector('.avatar');
                    var dropdown = document.getElementById('user-dropdown');
                    if (avatar && dropdown) {
                        if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
                            dropdown.classList.remove('show');
                        }
                    }
                });
            </script>
            @else
            <a href="{{ route('login') }}" style="text-decoration: none;">
                <div class="avatar" style="cursor: pointer;">P</div>
            </a>
            @endauth
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