<?php

namespace App\Notifications;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVideoNotification extends Notification
{
    use Queueable;

    protected $video;

    /**
     * Create a new notification instance.
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'video_id' => $this->video->id,
            'video_title' => $this->video->title,
            'channel_name' => $this->video->user->name,
            'channel_avatar' => $this->video->user->avatar,
            'message' => 'đã đăng một video mới: ' . $this->video->title,
        ];
    }
}
