<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Helpers\Slug;
use App\Models\Course;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class CourseLessons implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Course $course)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lessons = Youtube::getPlaylistItemsByPlaylistId($this->course->youtube_path);
        foreach($lessons['results'] as $lesson) {
            $info = $lesson->snippet;
            // $description = $info->description;
            // $title = $info->thumbnails->high->url;
            $this->course->lessons()->create([
                'order' => $info->position,
                'title' => $info->title,
                'slug' => Slug::uniqueSlug($info->title,'lessons'),
                'path_video' => $lesson->contentDetails->videoId
            ]);
        }
    }
}
