<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục - PolyFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;display=swap');
        
        body { font-family: 'Inter', system-ui, sans-serif; }
        .content { background: #0f0f0f; }
        
        /* SIDEBAR GIỐNG HỆT */
        .sidebar { background: #18181b; border-right: 1px solid #27272a; }
        .nav-item { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .nav-item:hover { background: #27272a; color: #FF6B00; }
        .nav-item.active { background: #27272a; color: #FF6B00; border-left: 4px solid #FF6B00; }
        
        .form-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .form-card:hover { box-shadow: 0 25px 50px -12px rgb(249 115 22 / 0.15); }
        
        .input-focus:focus {
            border-color: #FF6B00;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
        }
    </style>
</head>
<body class="bg-[#0f0f0f] text-white flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="sidebar w-64 flex-shrink-0 flex flex-col py-8 px-4">
        <div class="flex items-center gap-3 px-4 mb-10">
            <div class="w-9 h-9 bg-[#FF6B00] rounded-2xl flex items-center justify-center text-2xl">🍳</div>
            <h1 class="text-3xl font-bold tracking-tighter">PolyFood</h1>
        </div>
        
        <nav class="flex-1 space-y-1 px-3">
            <a href="#" class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-house w-6"></i><span>Dashboard</span>
            </a>
            <a href="#" class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-video w-6"></i><span>Video</span>
            </a>
            <a href="#" class="nav-item active flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-list-ul w-6"></i><span>Danh mục</span>
            </a>
            <a href="#" class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium">
                <i class="fa-solid fa-users w-6"></i><span>User</span>
            </a>
            <div class="flex-1"></div>
            <a href="#" onclick="if(confirm('Bạn muốn đăng xuất?')) {}" 
               class="nav-item flex items-center gap-4 px-5 py-4 rounded-3xl text-lg font-medium text-red-400 hover:text-red-500">
                <i class="fa-solid fa-right-from-bracket w-6"></i><span>Đăng xuất</span>
            </a>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 overflow-auto">
        <div class="content max-w-3xl mx-auto px-6 py-8">
            
            <!-- HEADER -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <button onclick="history.back()" class="flex items-center justify-center w-10 h-10 bg-[#272727] hover:bg-[#FF6B00] hover:text-black rounded-2xl transition">
                        <i class="fa-solid fa-arrow-left text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-4xl font-semibold">Thêm danh mục mới</h1>
                        <p class="text-zinc-400">Tạo danh mục công thức mới cho thư viện PolyFood</p>
                    </div>
                </div>
            </div>

            <!-- FORM CARD (đã bỏ Mô tả & Màu sắc) -->
            <div class="form-card bg-[#272727] rounded-3xl p-10">
                <form action="#" method="POST" class="space-y-8">
                    
                    <!-- Tên danh mục -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Tên danh mục <span class="text-red-400">*</span></label>
                        <input type="text" placeholder="Ví dụ: Món Việt Nam" 
                               class="input-focus w-full bg-[#18181b] border border-zinc-700 rounded-2xl px-6 py-4 text-white focus:outline-none text-lg">
                    </div>

                    <!-- Icon / Emoji -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Icon / Emoji</label>
                        <div class="flex gap-4 items-center">
                            <input type="text" id="emojiInput" value="🍲" maxlength="2"
                                   class="input-focus w-16 text-center text-5xl bg-[#18181b] border border-zinc-700 rounded-2xl px-4 py-3 focus:outline-none">
                            <button onclick="document.getElementById('emojiInput').value = prompt('Nhập emoji mới:', '🍲'); return false;" 
                                    class="px-6 py-3 bg-[#18181b] hover:bg-[#FF6B00] hover:text-black rounded-2xl text-sm font-medium transition">Chọn emoji khác</button>
                        </div>
                    </div>

                    <!-- Hình ảnh đại diện -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-2">Hình ảnh đại diện (thumbnail)</label>
                        <div class="border-2 border-dashed border-zinc-600 rounded-3xl p-8 text-center hover:border-[#FF6B00] transition">
                            <i class="fa-solid fa-cloud-upload text-4xl mb-4 text-zinc-500"></i>
                            <p class="text-zinc-400">Kéo thả hoặc <span class="text-[#FF6B00] cursor-pointer">chọn file</span></p>
                            <p class="text-xs text-zinc-500 mt-2">PNG, JPG • Tối đa 2MB</p>
                            <input type="file" class="hidden" accept="image/*">
                        </div>
                    </div>

                    <!-- Nút hành động -->
                    <div class="flex gap-4 pt-6 border-t border-zinc-700">
                        <button type="button" onclick="history.back()" 
                                class="flex-1 py-5 text-lg font-medium bg-[#18181b] hover:bg-zinc-700 rounded-3xl transition">
                            Hủy
                        </button>
                        <button type="submit" 
                                class="flex-1 py-5 text-lg font-semibold bg-[#FF6B00] hover:bg-orange-600 text-black rounded-3xl transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus"></i>
                            Tạo danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        tailwind.config = { theme: { extend: {} } }
    </script>
</body>
</html>