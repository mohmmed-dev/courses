<?php

namespace App\Filament\Admin\Resources\CourseResource\Pages;

use Alaouy\Youtube\Facades\Youtube;
use App\Filament\Admin\Resources\CourseResource;
use App\Helpers\Slug;
use App\Jobs\CourseLessons;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $playlist = Youtube::getPlaylistById($data['youtube_id']);
        if($playlist == false) {
            Notification::make()
            ->warning()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->send();
        $this->halt();
        }
        if(!$playlist->snippet) {
            Notification::make()
                ->warning()
                ->title('Invalid YouTube Playlist ID')
                ->body('Please provide a valid YouTube playlist ID.')
                ->persistent()
                ->send();
            $this->halt();
        }
        if($playlist->status->privacyStatus !== 'public') {
            Notification::make()
                ->warning()
                ->title('Playlist is not public')
                ->body('Please provide a public YouTube playlist ID.')
                ->persistent()
                ->send();
            $this->halt();
        }
        $info = $playlist->snippet;
        $data['title'] = $info->title;
        $data['slug'] = Slug::uniqueSlug($info->title,'courses');
        $data['description'] = $info->description;
        $data['thumbnail'] = $info->thumbnails->high->url;
        return $data;
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        Notification::make()
            ->success()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->send();
        CourseLessons::dispatch($this->record);
    }
}
