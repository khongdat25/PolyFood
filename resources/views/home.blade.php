@extends('layouts.master')
@section('title', 'Trang chủ')
@section('page', 'home')
@section('content')

        
        <!-- NỘI DUNG CHÍNH -->
        <div class="content">
            
            <!-- CHIPS -->
            <div class="chips">
                <div class="chip active">Tất cả</div>
                <div class="chip">Món Việt</div>
                <div class="chip">Món Âu</div>
                <div class="chip">Ăn vặt</div>
                <div class="chip">Healthy</div>
                <div class="chip">Video mới</div>
                <div class="chip">Nước chấm</div>
                <div class="chip">Chay ngon</div>
                <div class="chip">BBQ</div>
            </div>
            
            <!-- GRID 1 HÀNG 4 CÁI -->
            <div class="video-grid">
                
                <!-- Video 1 -->
            @foreach($video as $v)
                <div class="video-card">
                    <div class="thumbnail">
                        <img src="https://picsum.photos/id/201/600/400" alt="">
                        <span class="duration">{{$v->duration ?? '00:00:00'}}</span>
                    </div>
                    <div class="video-info">
                        <div class="channel-avatar">Food</div>
                        <div class="video-details">
                            <h3>{{$v->title}}</h3>
                            <p>PolyFood</p>
                            <p>{{$v->Views}} lượt xem • {{$v->create_at}}</p>
                        </div>
                    </div>
                </div>
            @endforeach





                
                
            </div>
        </div>
    </div>
@endsection