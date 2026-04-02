@extends('layouts.master')
@section('title', 'Trang chủ')
@section('page', 'home')
@section('content')

        
        <!-- NỘI DUNG CHÍNH -->
    <div class="content">
            
            <!-- CHIPS -->
            <div class="chips">
                <a href="{{ route('home') }}" class="chip active">Tất cả</a>

            @foreach($category as $c)
                <button class="chip" data-category="{{ $c->id }}">
                    {{ $c->name }}
                </button>
            @endforeach
            </div>
            <h2 id="title-news" style="margin:16px 0 8px; color:#fff;">Video mới</h2>
            <div class="video-grid" id="news"></div>

            <h2 id="title-random" style="margin:16px 0 8px; color:#fff;">Đề xuất</h2>
            <div class="video-grid" id="video-list"></div>

            <h2 id="title-catem" style="margin:16px 0 8px; color:#fff;">Video theo danh mục</h2>
            <div class="video-grid" id="video-by-cate"></div>
    </div>
</div>



<style>
.video-card:hover .menu-trigger { opacity: 1 !important; transform: translateY(-4px); }
</style>
<script>


        const video = @json($video);
        const news = @json($new);
        


        function renderVideos(videos, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            videos.forEach(v => {
                if (!v) return;

                const thumbnail = (!v.thumbnail || v.thumbnail.startsWith('http'))
                    ? v.thumbnail
                    : `/storage/${v.thumbnail}`;

                const avatar = v.user?.avatar 
                    ? `/storage/${v.user.avatar}`
                    : null;

                const isOwner = (v.user_id === window.authUserId);

                const html = `
                <div class="video-card" style="position:relative;">
                    <a href="/videos/${v.id}" style="text-decoration:none;">
                        <div class="thumbnail">
                            <img src="${thumbnail}" alt="${v.title}">
                            <span class="duration">${v.duration ?? '00:00'}</span>
                        </div>
                    </a>

                    <div class="video-info" style="display:flex; justify-content:space-between; padding:0">
                        <div style="display:flex; gap:12px; width:100%;">
                            
                            ${
                                avatar 
                                ? `<div class="channel-avatar"
                                        style="background-image:url('${avatar}'); background-size:cover; cursor:pointer;"
                                        onclick="location.href='/channel/${v.user?.id ?? 1}'"></div>`
                                : `<div class="channel-avatar"
                                        onclick="location.href='/channel/${v.user?.id ?? 1}'">
                                        ${(v.user?.name ?? 'P').charAt(0)}
                                </div>`
                            }

                            <div class="video-details">
                                <h3>${v.title}</h3>
                                <p>${v.user?.name ?? 'PolyFood'}</p>
                                <p>${Number(v.views ?? 0).toLocaleString()} lượt xem ${v.time_ago ?? ''} </p>
                            </div>
                        </div>

                        <!-- MENU -->
                        <div style="position:relative; margin-top:4px; " class="video-menu-container">
        
        <button class="menu-trigger"
            style="background:transparent;color:#fff;border:none;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;opacity:0;transition:opacity 0.2s;"
            onclick="toggleMenu(event, 'menu-search-${v.id}')"
            title="Tùy chọn">

            <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18">
                <path d="M12 16.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zM10.5 12c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5zm0-6c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5-1.5.67-1.5 1.5z"></path>
            </svg>
        </button>

        <div id="menu-search-${v.id}" class="dropdown-menu"
            style="display:none;position:absolute;top:36px;right:0;background:#272727;border-radius:12px;padding:8px;box-shadow:0 8px 24px rgba(0,0,0,0.8);min-width:160px;z-index:100;">

            ${
                isOwner
                ? `
                <a href="/videos/${v.id}/edit"
                    style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;">
                    ✏️ Chỉnh sửa
                </a>

                <form action="/videos/${v.id}" method="POST" onsubmit="return confirm('Xóa video này?')" style="margin:0;">
                    <input type="hidden" name="_token" value="${window.csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"
                        style="display:flex;align-items:center;gap:12px;width:100%;text-align:left;padding:10px 12px;background:transparent;color:#f87171;border:none;border-radius:8px;font-size:14px;cursor:pointer;">
                        🗑️ Xóa
                    </button>
                </form>
                `
                : ''
            }

            <a href="#" onclick="event.preventDefault(); alert('Chức năng Chia sẻ sẽ sớm ra mắt!');"
                style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;">
                ↗️ Chia sẻ
            </a>

            <a href="#" onclick="event.preventDefault(); alert('Chức năng Tải xuống sẽ sớm ra mắt!');"
                style="display:flex;align-items:center;gap:12px;padding:10px 12px;color:#fff;text-decoration:none;border-radius:8px;font-size:14px;">
                ⬇️ Tải xuống
            </a>
        </div>
    </div>
            `;

            container.innerHTML += html;
        });
    }

    // chạy
    renderVideos(video, 'video-list');
    renderVideos(news, 'news');

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

const videoByCate = @json($videoByCate);

document.querySelectorAll('.chip[data-category]').forEach(chip => {
    chip.addEventListener('click', function() {

        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        const cateId = this.dataset.category;

        const filtered = videoByCate.filter(v => v.category_id == cateId);

        // Ẩn section cũ
        document.getElementById('video-list').style.display = 'none';
        document.getElementById('news').style.display = 'none';

        // Hiện section lọc
        document.getElementById('video-by-cate').style.display = 'grid';

        renderVideos(filtered, 'video-by-cate');
    });
});

document.querySelectorAll('.chip[data-category]').forEach(chip => {
    chip.addEventListener('click', function() {

        // active UI
        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        const cateId = this.dataset.category;

        const filtered = videoByCate.filter(v => v.category_id == cateId);

        // ❌ Ẩn home
        document.getElementById('news').style.display = 'none';
        document.getElementById('video-list').style.display = 'none';
        document.getElementById('title-news').style.display = 'none';
        document.getElementById('title-random').style.display = 'none';

        // ✅ Hiện cate
        document.getElementById('video-by-cate').style.display = 'grid';
        document.getElementById('title-cate').style.display = 'block';

        renderVideos(filtered, 'video-by-cate');
    });
});
</script>
@endsection