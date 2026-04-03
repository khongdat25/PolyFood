<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Subscribe/Unsubscribe toggle
     */
    public function toggle($channelId)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        $subscriber = Auth::user();
        if ($subscriber->id == $channelId) {
            return response()->json(['message' => 'Bạn không thể tự đăng ký chính mình'], 422);
        }

        $channel = User::findOrFail($channelId);

        if ($subscriber->isSubscribedTo($channelId)) {
            $subscriber->subscriptions()->detach($channelId);
            $status = 'unsubscribed';
        } else {
            $subscriber->subscriptions()->attach($channelId);
            $status = 'subscribed';
        }

        $subscribersCount = $channel->subscribers()->count();
        $viewsCount = $channel->videos()->sum('views');

        return response()->json([
            'status' => $status,
            'subscribersCount' => number_format($subscribersCount),
            'viewsCount' => number_format($viewsCount)
        ]);
    }
}
