@extends('layouts.master')
@section('title', 'Trang chủ')
@section('page', 'home')
@section('content')

        
        <!-- NỘI DUNG CHÍNH -->
        <div class="content">
            
            <!-- CHIPS -->
            <div class="chips">
                <a href="{{ route('search') }}" class="chip active">Tất cả</a>
                <a href="{{ route('search', ['q' => 'Món Việt']) }}" class="chip">Món Việt</a>
                <a href="{{ route('search', ['q' => 'Món Âu']) }}" class="chip">Món Âu</a>
                <a href="{{ route('search', ['q' => 'Ăn vặt']) }}" class="chip">Ăn vặt</a>
                <a href="{{ route('search', ['q' => 'Healthy']) }}" class="chip">Healthy</a>
                <a href="{{ route('search', ['q' => 'chay']) }}" class="chip">Chay ngon</a>
                <a href="{{ route('search', ['q' => 'nước chấm']) }}" class="chip">Nước chấm</a>
                <a href="{{ route('search', ['q' => 'BBQ']) }}" class="chip">BBQ</a>
                <a href="{{ route('search', ['q' => 'Mới nhất']) }}" class="chip">Video mới</a>
                <a href="{{ route('search', ['q' => 'Xu hướng']) }}" class="chip">Xu hướng</a>
            </div>
            
            <!-- GRID 1 HÀNG 4 CÁI -->
            <div class="video-grid">
                
                <!-- Video Danh sách -->
            @foreach($video as $v)
                <div class="video-card">
                    <div class="thumbnail">
                        <img src="{{ $v->thumbnail }}" alt="{{ $v->title }}">
                        <span class="duration">{{ $v->duration ?? '10:00' }}</span>
                    </div>
                    <div class="video-info">
                        <div class="channel-avatar">P</div>
                        <div class="video-details">
                            <h3>{{ $v->title }}</h3>
                            <p>PolyFood • {{ number_format($v->views) }} lượt xem</p>
                        </div>
                    </div>
                </div>
            @endforeach         
                
            </div>
        </div>
    </div>
@endsection