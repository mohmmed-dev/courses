<?php

namespace App\Filament\Admin\Resources\TeacherResource\Pages;

use App\Filament\Admin\Resources\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Alaouy\Youtube\Facades\Youtube;
use App\Helpers\Slug;
use App\Models\Teacher;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
    $video = $data['channel_id'];
    $info = Youtube::getVideoInfo($video);
    if($info == false) {
        \Filament\Notifications\Notification::make()
            ->title('Invalid Video ID')
            ->body('The provided channel ID does not exist or is invalid.')
            ->danger()
            ->persistent()
            ->send();
        $this->halt();
    }
    $channel = Youtube::getChannelById($info->snippet->channelId);
    if($channel == false) {
        \Filament\Notifications\Notification::make()
            ->title('Invalid Channel ID')
            ->body('The provided channel ID does not exist or is invalid.')
            ->danger()
            ->persistent()
            ->send();
        $this->halt();
    }
    $slug = str_replace('@', '', $channel->snippet->customUrl);
    if(Teacher::where('slug' ,$slug)->exists()) {
        \Filament\Notifications\Notification::make()
            ->title('Channel Already Exists')
            ->body('A teacher with this channel already exists.')
            ->danger()
            ->persistent()
            ->send();
        $this->halt();
    }
    $data["channel_id"] = $info->snippet->channelId;
    $data["name"] = $channel->snippet->title;
    $data["slug"] = $slug ;
    $data["avatar"] = $channel->snippet->thumbnails->high->url;
    return $data;
    }
}
