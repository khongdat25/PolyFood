<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục - PolyFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;display=swap');
        
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }
        
        .content {
            background: #0f0f0f;
        }
        
        /* SIDEBAR */
        .sidebar {
            background: #18181b;
            border-right: 1px solid #27272a;
        }
        
        .nav-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-item:hover {
            background: #27272a;
            color: #FF6B00;
        }
        
        .nav-item.active {
            background: #27272a;
            color: #FF6B00;
            border-left: 4px solid #FF6B00;
        }
        
        .category-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .category-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgb(249 115 22 / 0.15);
        }
        
        .chip {
            background: #272727;
            transition: all 0.3s;
        }
        
        .chip:hover, .chip.active {
            background: #fff;
            color: #000;
        }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px 16px;
        }
        
        .thumbnail img {
            transition: border-radius 0.2s;
        }
        
        .video-card:hover .thumbnail img {
            border-radius: 0;
        }
        
        .menu-trigger {
            opacity: 0;
            transition: all 0.2s;
        }
        
        .video-card:hover .menu-trigger {
            opacity: 1;
        }
        
        .dropdown-menu {
            animation: fadeIn 0.2s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white flex min-h-screen">

    <!-- ==================== SIDEBAR TRÁI ==================== -->
    <div class="sidebar w-64 flex-shrink-0 flex flex-col py-8 px-4">
        
        <!-- Logo -->
        <div class="flex items-center gap-3 px-4 mb-10">
            <div class="w-9 h-9 bg-[#FF6B00] rounded-2xl flex items-center justify-center text-2xl">🍳</div>
            <h1 class="text-3xl font-bold tracking-tighter">PolyFood</h1>
        </div>

        <!-- Menu -->
        <nav class="flex-1 space-y-1 px-3">
            
            <!-- Dashboard -->
            <a href="#" 
               class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-house w-6"></i>
                <span>Dashboard</span>
            </a>
            
            <!-- Video -->
            <a href="#" 
               class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-video w-6"></i>
                <span>Video</span>
            </a>
            
            <!-- Danh mục (đang active) -->
            <a href="{{ route('search') }}" 
               class="nav-item active flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-list-ul w-6"></i>
                <span>Danh mục</span>
            </a>
            
            <!-- User -->
            <a href="#" 
               class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-users w-6"></i>
                <span>User</span>
            </a>

            <!-- Spacer -->
            <div class="flex-1"></div>

            <!-- Đăng xuất -->
            <a href="#" onclick="if(confirm('Bạn muốn đăng xuất?')) { /* Laravel: route('logout') */ }"
               class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium text-red-400 hover:text-red-500">
                <i class="fa-solid fa-right-from-bracket w-6"></i>
                <span>Đăng xuất</span>
            </a>
        </nav>

        <!-- Footer sidebar (tùy chọn) -->
        <div class="px-5 mt-auto pt-8 border-t border-zinc-800 text-xs text-zinc-500 flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>v1.0 • PolyFood Admin</span>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="flex-1 overflow-auto">
        <div class="content max-w-7xl mx-auto px-6 py-8">
            
            <!-- HEADER DANH MỤC -->
            <div class="flex items-center gap-4 mb-8 border-b border-zinc-800 pb-6">
                <button onclick="history.back()" 
                        class="flex items-center justify-center w-10 h-10 bg-[#272727] hover:bg-[#FF6B00] hover:text-black rounded-2xl transition">
                    <i class="fa-solid fa-arrow-left text-xl"></i>
                </button>
                <div>
                    <h1 class="text-4xl font-semibold">Danh mục</h1>
                    <p class="text-zinc-400 mt-1">Khám phá công thức theo sở thích của bạn</p>
                </div>
            </div>

            <!-- CATEGORY GRID -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6 mb-16">
                
                <!-- Các card danh mục (giữ nguyên như trước) -->
                <a href="{{ route('search', ['q' => 'Món Việt']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-orange-500 to-amber-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🍲</div>
                        <h3 class="text-2xl font-semibold mb-1">Món Việt</h3>
                        <p class="text-zinc-400 text-sm">Phở, bún, cơm tấm...</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-[#FF6B00] flex items-center gap-2">
                            <span>248 video</span>
                            <i class="fa-solid fa-fire"></i>
                        </div>
                    </div>
                </a>

                <!-- Món Âu -->
                <a href="{{ route('search', ['q' => 'Món Âu']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-blue-500 to-cyan-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🍝</div>
                        <h3 class="text-2xl font-semibold mb-1">Món Âu</h3>
                        <p class="text-zinc-400 text-sm">Pasta, steak, salad...</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-blue-400 flex items-center gap-2">
                            <span>187 video</span>
                        </div>
                    </div>
                </a>

                <!-- Ăn vặt -->
                <a href="{{ route('search', ['q' => 'Ăn vặt']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-rose-500 to-pink-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🍟</div>
                        <h3 class="text-2xl font-semibold mb-1">Ăn vặt</h3>
                        <p class="text-zinc-400 text-sm">Snack, đồ chiên...</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-rose-400 flex items-center gap-2">
                            <span>320 video</span>
                        </div>
                    </div>
                </a>

                <!-- Healthy -->
                <a href="{{ route('search', ['q' => 'Healthy']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🥗</div>
                        <h3 class="text-2xl font-semibold mb-1">Healthy</h3>
                        <p class="text-zinc-400 text-sm">Ăn kiêng, dinh dưỡng</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-emerald-400 flex items-center gap-2">
                            <span>95 video</span>
                        </div>
                    </div>
                </a>

                <!-- Chay ngon -->
                <a href="{{ route('search', ['q' => 'chay']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-lime-500 to-green-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🌱</div>
                        <h3 class="text-2xl font-semibold mb-1">Chay ngon</h3>
                        <p class="text-zinc-400 text-sm">Món chay hấp dẫn</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-lime-400 flex items-center gap-2">
                            <span>110 video</span>
                        </div>
                    </div>
                </a>

                <!-- Nước chấm -->
                <a href="{{ route('search', ['q' => 'nước chấm']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-amber-500 to-yellow-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🥢</div>
                        <h3 class="text-2xl font-semibold mb-1">Nước chấm</h3>
                        <p class="text-zinc-400 text-sm">Công thức nước chấm</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-amber-400 flex items-center gap-2">
                            <span>45 video</span>
                        </div>
                    </div>
                </a>

                <!-- BBQ -->
                <a href="{{ route('search', ['q' => 'BBQ']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-red-500 to-orange-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🔥</div>
                        <h3 class="text-2xl font-semibold mb-1">BBQ</h3>
                        <p class="text-zinc-400 text-sm">Nướng & BBQ</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-red-400 flex items-center gap-2">
                            <span>85 video</span>
                        </div>
                    </div>
                </a>

                <!-- Mới nhất -->
                <a href="{{ route('search', ['q' => 'Mới nhất']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-purple-500 to-violet-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">✨</div>
                        <h3 class="text-2xl font-semibold mb-1">Mới nhất</h3>
                        <p class="text-zinc-400 text-sm">Video vừa ra mắt</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-purple-400 flex items-center gap-2">
                            <span>62 video</span>
                        </div>
                    </div>
                </a>

                <!-- Xu hướng -->
                <a href="{{ route('search', ['q' => 'Xu hướng']) }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-pink-500 to-rose-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">🔥</div>
                        <h3 class="text-2xl font-semibold mb-1">Xu hướng</h3>
                        <p class="text-zinc-400 text-sm">Đang hot tuần này</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-pink-400 flex items-center gap-2">
                            <span>134 video</span>
                        </div>
                    </div>
                </a>

                <!-- Tất cả -->
                <a href="{{ route('search') }}" class="category-card bg-[#272727] rounded-3xl overflow-hidden group">
                    <div class="h-2 bg-gradient-to-r from-zinc-400 to-zinc-500"></div>
                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition">📚</div>
                        <h3 class="text-2xl font-semibold mb-1">Tất cả</h3>
                        <p class="text-zinc-400 text-sm">Toàn bộ thư viện</p>
                        <div class="mt-auto pt-8 text-xs font-medium text-zinc-400 flex items-center gap-2">
                            <span>1.2K video</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- VIDEO NỔI BẬT (tùy chọn) -->
            <div class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold">Video nổi bật trong danh mục</h2>
                    <a href="{{ route('search') }}" class="text-[#FF6B00] hover:underline flex items-center gap-2 text-sm">
                        Xem tất cả <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Bạn có thể paste video-grid từ home.blade.php vào đây -->
                <div class="video-grid">
                    <!-- Video cards sẽ được copy từ file home.blade.php của bạn -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tailwind script
        tailwind.config = {
            content: [],
            theme: {
                extend: {}
            }
        }

        // Toggle menu (giữ nguyên như trước)
        function toggleMenu(e, menuId) {
            e.preventDefault();
            e.stopPropagation();
            const menu = document.getElementById(menuId);
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m.id !== menuId) m.style.display = 'none';
            });
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.video-menu-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
            }
        });
    </script>
</body>
</html>