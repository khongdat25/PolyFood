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
            <a href="{{ route('category.index') }}" 
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
            <div class="flex items-center justify-between mb-8 border-b border-zinc-800 pb-6">
                <div class="flex items-center gap-4">
                    <button onclick="history.back()" 
                            class="flex items-center justify-center w-10 h-10 bg-[#272727] hover:bg-[#FF6B00] hover:text-black rounded-2xl transition">
                        <i class="fa-solid fa-arrow-left text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-4xl font-semibold">Danh mục</h1>
                        <p class="text-zinc-400 mt-1">Quản lý và cập nhật danh mục của bạn</p>
                    </div>
                </div>
                
                <!-- Nút Thêm Mới -->
                <a href="{{ route('category.create') }}" 
                   class="flex items-center gap-2 px-6 py-3 bg-[#FF6B00] hover:bg-orange-600 text-black font-semibold rounded-2xl transition shadow-lg shadow-orange-900/20">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm danh mục</span>
                </a>
            </div>

            <!-- CATEGORY GRID -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-6 mb-16">
                
                @foreach($categories as $category)
                <div class="category-card bg-[#272727] rounded-3xl overflow-hidden group relative {{ !$category->status ? 'opacity-50 grayscale-[0.5]' : '' }}">
                    <!-- Thanh trang trí phía trên -->
                    <div class="h-2 {{ $category->status ? 'bg-gradient-to-r from-orange-500 to-amber-500' : 'bg-zinc-600' }}"></div>
                    
                    <!-- Nút Thao tác -->
                    <div class="absolute top-4 right-4 z-10 flex gap-2">
                        <!-- Nút Ẩn/Hiện -->
                        <form action="{{ route('category.toggle-status', $category->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="flex items-center justify-center w-8 h-8 bg-zinc-800/80 hover:bg-zinc-700 text-zinc-400 hover:text-white rounded-xl transition backdrop-blur-sm"
                                    title="{{ $category->status ? 'Ẩn danh mục' : 'Hiện danh mục' }}">
                                <i class="fa-solid {{ $category->status ? 'fa-eye' : 'fa-eye-slash' }} text-xs"></i>
                            </button>
                        </form>

                        <!-- Nút Sửa -->
                        <a href="{{ route('category.edit', $category->id) }}" 
                           class="flex items-center justify-center w-8 h-8 bg-zinc-800/80 hover:bg-[#FF6B00] text-zinc-400 hover:text-black rounded-xl transition backdrop-blur-sm"
                           title="Sửa danh mục">
                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </a>
                    </div>

                    <div class="p-8 flex flex-col items-center text-center">
                        <div class="text-6xl mb-6 group-hover:scale-110 transition cursor-default">
                            {{ $category->icon ?: '🍲' }}
                        </div>
                        <h3 class="text-2xl font-semibold mb-1 truncate w-full px-2">{{ $category->name }}</h3>
                        <p class="text-zinc-400 text-sm italic">/{{ $category->slug }}</p>
                        
                        <div class="mt-auto pt-8 flex items-center justify-between w-full">
                            <div class="text-xs font-medium text-[#FF6B00] flex items-center gap-2">
                                <span>{{ $category->videos_count ?? 0 }} video</span>
                                <i class="fa-solid fa-play"></i>
                            </div>
                            
                            @if(!$category->status)
                            <span class="text-[10px] bg-zinc-800 text-zinc-500 px-2 py-1 rounded-lg uppercase tracking-wider font-bold">Bị ẩn</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                @if($categories->isEmpty())
                <div class="col-span-full py-20 text-center">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-xl text-zinc-500">Chưa có danh mục nào được tạo.</h3>
                    <a href="{{ route('category.create') }}" class="text-[#FF6B00] hover:underline mt-2 inline-block">Thêm danh mục ngay</a>
                </div>
                @endif
            </div>
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