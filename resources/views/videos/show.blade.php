@extends('layouts.master')
@section('title', $video->title)
@section('page', 'watch')

@section('content')
<div class="watch-container">
    
    <!-- Main Column -->
    <div class="main-column">
        <div class="video-player-container">
            <video id="main-video" controls autoplay muted playsinline preload="auto" style="width:100%; height:100%;">
                @if($video->video_url && !Str::startsWith($video->video_url, ['http', 'https']))
                    <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                @else
                    <source src="{{ $video->video_url }}" type="video/mp4">
                @endif
                Trình duyệt của bạn không hỗ trợ thẻ video.
            </video>
        </div>

        <div class="video-metadata">
            <h1 class="video-title">{{ $video->title }}</h1>
            
            <div class="video-actions">
                <div class="channel-info">
                    @if($video->user && $video->user->avatar)
                        <img src="{{ asset('storage/' . $video->user->avatar) }}" class="channel-avatar" onclick="location.href='{{ route('channel', $video->user->id) }}'">
                    @else
                        <div class="channel-avatar" style="background:#ff4e00; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;" onclick="location.href='{{ route('channel', $video->user->id ?? 1) }}'">
                            {{ substr($video->user->name ?? 'P', 0, 1) }}
                        </div>
                    @endif
                    <div class="channel-details">
                        <span class="channel-name" onclick="location.href='{{ route('channel', $video->user->id ?? 1) }}'">{{ $video->user->name ?? 'PolyFood' }}</span>
                        <span class="subscriber-count">{{ number_format($video->user->videos()->sum('views') ?? 0) }} lượt xem kênh</span>
                    </div>
                    <button class="subscribe-btn" onclick="alert('Tính năng Đăng ký sẽ sớm ra mắt!')">Đăng ký</button>
                </div>

                <div class="action-buttons">
                    <button class="action-btn" onclick="alert('Tính năng Thích sẽ sớm ra mắt!')">👍 Thích</button>
                    <button class="action-btn" onclick="alert('Tính năng Chia sẻ sẽ sớm ra mắt!')">↗️ Chia sẻ</button>
                    <button class="action-btn" style="padding: 8px 12px;">•••</button>
                </div>
            </div>

            <div class="description-box">
                <div class="stats">
                    {{ number_format($video->views) }} lượt xem • {{ $video->create_at ? \Carbon\Carbon::parse($video->create_at)->format('d/m/Y') : 'Vừa đăng' }}
                </div>
                <div class="description-text">{{ $video->description ?: 'Không có mô tả cho video này.' }}</div>
            </div>
        </div>
    </div>

    <!-- Sidebar (Related Videos) -->
    <div class="side-column">
        <h3>Video liên quan</h3>
        
        @forelse($relatedVideos as $v)
            @php
                $itemThumbnail = (! $v->thumbnail || Str::startsWith($v->thumbnail, 'http'))
                    ? $v->thumbnail
                    : asset('storage/' . $v->thumbnail);
            @endphp
            <a href="{{ route('videos.show', $v->id) }}" class="related-video-card">
                <div class="related-thumbnail">
                    <img src="{{ $itemThumbnail }}" alt="{{ $v->title }}">
                    <span class="related-duration">{{ $v->duration ?? '00:00' }}</span>
                </div>
                <div class="related-info">
                    <div class="related-title">{{ $v->title }}</div>
                    <div class="related-channel">{{ $v->user->name ?? 'PolyFood' }}</div>
                    <div class="related-stats">{{ number_format($v->views) }} lượt xem • {{ $v->time_ago }}</div>
                </div>
            </a>
        @empty
            <p style="color:#aaa; font-size:14px;">Không có video liên quan.</p>
        @endforelse
    </div>

</div>

<script>
    // YouTube style autoplay is usually blocked unless muted or interacted with.
    // We have 'autoplay' in the tag, but we can ensure it tries to play.
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.querySelector('video');
        if (video) {
            video.play().catch(error => {
                console.log("Autoplay was prevented by the browser. Interaction required.");
            });
        }
    });
</script>
@endsection
