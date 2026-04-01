<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - PolyFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0f0f0f;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
    
    <div class="w-full max-w-md">
        <!-- Logo -->
        <a href="/" class="flex justify-center mb-10 text-decoration-none hover:opacity-90 transition">
            <div class="flex items-center gap-3">
                <div class="w-14 h-14 bg-orange-600 rounded-2xl flex items-center justify-center text-white text-4xl font-bold shadow-lg">P</div>
                <div>
                    <h1 class="text-4xl font-bold text-white tracking-tighter">PolyFood</h1>
                    <p class="text-sm text-gray-500 -mt-1">Nấu ăn ngon mỗi ngày</p>
                </div>
            </div>
        </a>

        <!-- Card -->
        <div class="bg-[#181818] rounded-3xl p-8 shadow-2xl border border-gray-800">
            <h2 class="text-3xl font-semibold text-white text-center mb-8">Đăng nhập</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-[#272727] border border-gray-700 focus:border-orange-500 focus:ring-0 rounded-2xl px-6 py-4 text-white placeholder-gray-500 transition"
                           placeholder="Nhập email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-400 mb-2">Mật khẩu</label>
                    <input type="password" name="password" required autocomplete="current-password"
                           class="w-full bg-[#272727] border border-gray-700 focus:border-orange-500 focus:ring-0 rounded-2xl px-6 py-4 text-white placeholder-gray-500 transition"
                           placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-gray-400 text-sm">
                        <input type="checkbox" name="remember" class="w-4 h-4 accent-orange-600" {{ old('remember') ? 'checked' : '' }}>
                        Ghi nhớ tôi
                    </label>
                    <a href="{{ route('password.request') }}" class="text-orange-500 hover:text-orange-400 text-sm transition">Quên mật khẩu?</a>
                </div>

                <button type="submit"
                        class="w-full bg-orange-600 hover:bg-orange-700 transition-all py-4 rounded-2xl font-semibold text-white text-lg shadow-lg">
                    Đăng nhập
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-8">
                <div class="flex-1 h-px bg-gray-700"></div>
                <span class="px-6 text-gray-500 text-sm">hoặc</span>
                <div class="flex-1 h-px bg-gray-700"></div>
            </div>

            <!-- Google -->
            <button class="w-full bg-[#272727] hover:bg-[#323232] border border-gray-700 py-4 rounded-2xl flex items-center justify-center gap-3 transition">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/2048px-Google_%22G%22_logo.svg.png" 
                     alt="Google" class="h-6">
                <span class="text-white font-medium">Tiếp tục với Google</span>
            </button>

            <p class="text-center text-gray-400 mt-8 text-sm">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-400 font-medium">Đăng ký ngay</a>
            </p>
        </div>

        <p class="text-center text-gray-500 text-xs mt-8">
            © 2026 PolyFood
        </p>
    </div>

</body>
</html>
