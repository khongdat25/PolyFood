<?php

namespace App\Http\Controllers\users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Helpers\VideoHelper;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    function index(){
        $video= Video::all();
        foreach ($video as $v) {
            $v->duration = VideoHelper::getDurationFromUrl($v->video_url);
        }
        return view('home', compact('video'));
    }
}
