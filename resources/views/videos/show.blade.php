@extends('layouts.master')
@section('title', $video->title)
@section('page', 'watch')

@section('content')
<div style="background:#0f0f0f; min-height:calc(100vh - 64px); color:#fff; padding:24px;">
    <div style="max-width:1200px; margin:0 auto; display:flex; gap:24px; flex-wrap:wrap;">
        
        <!-- Cột Video -->
        <div style="flex: 1 1 70%; min-width:300px;">
            <video controls autoplay style="width:100%; border-radius:12px; background:#000; aspect-ratio: 16/9;">
                @if($video->video_url && !Str::startsWith($video->video_url, ['http', 'https']))
                    <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
                @else
                    <source src="{{ $video->video_url }}" type="video/mp4">
                @endif
                Trình duyệt của bạn không hỗ trợ thẻ video.
            </video>
            
            <h1 style="font-size:20px; font-weight:600; margin:16px 0 8px;">{{ $video->title }}</h1>
            
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
                <!-- Kênh -->
                <div style="display:flex; align-items:center; gap:12px;">
                    @if($video->user && $video->user->avatar)
                        <img src="{{ asset('storage/' . $video->user->avatar) }}" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                    @else
                        <div style="width:40px; height:40px; border-radius:50%; background:#ff4e00; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                            {{ substr($video->user->name ?? 'P', 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <div style="font-weight:600;">{{ $video->user->name ?? 'PolyFood' }}</div>
                        <div style="font-size:12px; color:#aaa;">{{ number_format($video->user->videos()->sum('views') ?? 0) }} lượt xem kênh</div>
                    </div>
                </div>
                
                <!-- Format Số Liệu -->
                <div style="display:flex; gap:12px; font-size:14px;">
                    <button style="background:#272727; color:#fff; border:none; padding:8px 16px; border-radius:18px; cursor:pointer;" onclick="alert('Tính năng thích sẽ sớm ra mắt!')">👍 Thích</button>
                    <button style="background:#272727; color:#fff; border:none; padding:8px 16px; border-radius:18px; cursor:pointer;" onclick="alert('Tính năng chia sẻ sẽ sớm ra mắt!')">↗️ Chia sẻ</button>
                </div>
            </div>
            
            <div style="background:#272727; padding:12px; border-radius:12px; margin-top:16px; font-size:14px; line-height:1.5;">
                <div style="font-weight:600; margin-bottom:8px;">
                    {{ number_format($video->views) }} lượt xem • {{ $video->create_at ? \Carbon\Carbon::parse($video->create_at)->format('d/m/Y') : 'Vừa đăng' }}
                </div>
                <div style="white-space:pre-wrap;">{{ $video->description ?: 'Không có mô tả.' }}</div>
            </div>
        </div>
        
    </div>
</div>
@endsection
