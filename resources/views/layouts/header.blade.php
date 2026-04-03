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
            
            <div class="notification-container" style="position: relative;">
                <i class="bell-btn" onclick="document.getElementById('notification-dropdown').classList.toggle('show')" style="cursor: pointer; position: relative;">
                    🛎️
                    @auth
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span class="notification-badge" style="position: absolute; top: -5px; right: -5px; background: #ff4e00; color: #fff; font-size: 10px; padding: 2px 5px; border-radius: 50%; font-style: normal;">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    @endauth
                </i>

                <!-- Notification Dropdown -->
                <div id="notification-dropdown" class="notification-dropdown" style="display: none; position: absolute; right: 0; top: 120%; background: #272727; border: 1px solid #3f3f3f; border-radius: 12px; width: 320px; max-height: 400px; overflow-y: auto; z-index: 1000; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);">
                    <div style="padding: 12px 16px; border-bottom: 1px solid #3f3f3f; display: flex; justify-content: space-between; align-items: center;">
                        <h4 style="margin: 0; color: #fff; font-size: 16px;">Thông báo</h4>
                        @auth
                            <a href="#" style="font-size: 12px; color: #f97316; text-decoration: none;">Đánh dấu đã đọc</a>
                        @endauth
                    </div>

                    @auth
                        @forelse(Auth::user()->notifications()->latest()->limit(10)->get() as $notification)
                            <a href="{{ route('videos.show', $notification->data['video_id']) }}" class="notification-item" style="display: flex; gap: 12px; padding: 12px 16px; text-decoration: none; border-bottom: 1px solid #2a2a2a; transition: 0.2s; {{ $notification->read_at ? 'opacity: 0.7;' : 'background: rgba(249, 115, 22, 0.05);' }}">
                                <div style="flex-shrink: 0;">
                                    @if(isset($notification->data['channel_avatar']))
                                        <img src="{{ asset('storage/' . $notification->data['channel_avatar']) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #3f3f3f; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                            {{ substr($notification->data['channel_name'] ?? 'P', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <p style="margin: 0; color: #fff; font-size: 13px; line-height: 1.4;">
                                        <strong style="color: #f97316;">{{ $notification->data['channel_name'] }}</strong> 
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <span style="font-size: 11px; color: #aaa;">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @empty
                            <div style="padding: 40px 16px; text-align: center; color: #aaa;">
                                <div style="font-size: 32px; margin-bottom: 8px;">🛎️</div>
                                <p style="margin: 0; font-size: 14px;">Chưa có thông báo nào</p>
                            </div>
                        @endforelse
                    @else
                        <div style="padding: 40px 16px; text-align: center; color: #aaa;">
                            <p style="margin: 0; font-size: 14px;">Vui lòng đăng nhập để xem thông báo</p>
                        </div>
                    @endauth
                </div>
            </div>

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
                .user-dropdown-menu.show, .notification-dropdown.show { display: block !important; }
                .notification-item:hover { background: #3f3f3f !important; }
            </style>
            <script>
                // Đóng menu nếu click ra ngoài vùng avatar hoặc bell
                document.addEventListener('click', function(event) {
                    var avatar = document.querySelector('.avatar');
                    var dropdown = document.getElementById('user-dropdown');
                    var bell = document.querySelector('.bell-btn');
                    var notiDropdown = document.getElementById('notification-dropdown');

                    if (avatar && dropdown) {
                        if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
                            dropdown.classList.remove('show');
                        }
                    }

                    if (bell && notiDropdown) {
                        if (!bell.contains(event.target) && !notiDropdown.contains(event.target)) {
                            notiDropdown.classList.remove('show');
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
            <a href="/category"><div class="sidebar-item"><i>🔥</i> Bài viết</div></a>
            <div class="sidebar-item"><i>❤️</i> Đã thích</div>
            <div class="sidebar-item"><i>📜</i> Lịch sử xem</div>
        </aside>