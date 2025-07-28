<?php

namespace App\Jobs;

use Alaouy\Youtube\Facades\Youtube;
use App\Helpers\Slug;
use App\Models\Course;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;



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
        // $lessons = Youtube::getPlaylistItemsByPlaylistId($this->course->youtube_path);
        // foreach($lessons['results'] as $lesson) {
        //     $info = $lesson->snippet;
        //     // $description = $info->description;
        //     // $title = $info->thumbnails->high->url;
        //     $this->course->lessons()->create([
        //         'order' => $info->position,
        //         'title' => $info->title,
        //         'slug' => Str::slug($info->title),
        //         'path_video' => $lesson->contentDetails->videoId
        //     ]);
        // }
        $this->course->asyncLessons($this->getPlaylistVideos($this->course->youtube_id)['items']);
    }

    public function getPlaylistVideos(string $playlistId)
        {
            $allPlaylistItemsRaw = []; // لتخزين البيانات الأولية من API
            $videoIds = [];
            $totalDurationSeconds = 0;
            $nextPageToken = null;
            $orderCounter = 0; // لتعيين قيمة 'order'

        try {
            do {
                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

                $response = Youtube::getPlaylistItemsByPlaylistId($playlistId,$nextPageToken);
                if (!is_array($response) || !isset($response['results'])) {
                    throw new Exception('Invalid response from YouTube API');
                }
                foreach ($response['results'] as $item) {
                    if($item->status->privacyStatus != 'public') {
                        continue; 
                    }
                    $videoId = $item->contentDetails->videoId;
                    if ($videoId) {
                        $orderCounter++;
                        $videoIds[] = $videoId;
                        $allPlaylistItemsRaw[$videoId] = [
                            'order' => $orderCounter, // ترتيب مؤقت للحفاظ على الترتيب الأصلي
                            'title' => $item->snippet->title,
                            'slug' => Slug::uniqueSlug($item->snippet->title,'lessons'),
                            'thumbnail' => $item->snippet->thumbnails->default->url ?? null,
                            'path_video' => $videoId, // حفظ ID مؤقتا للربط
                        ];
                    }
                }
                $nextPageToken = $response['info']['nextPageToken'] ?? null;

            } while ($nextPageToken);
            // استرداد تفاصيل الفيديوهات (المدة والمشاهدات) باستخدام Video IDs
            if (!empty($videoIds)) {
                $chunkedVideoIds = array_chunk($videoIds, 50);

                foreach ($chunkedVideoIds as $chunk) {
                    // طلب بيانات 'contentDetails' (للمدة) و 'statistics' (لعدد المشاهدات)
                    $videosInfo = Youtube::getVideoInfo($chunk, ['part' => 'contentDetails,statistics']);
                    if (!is_array($videosInfo) && !is_null($videosInfo)) {
                        $videosInfo = [$videosInfo];
                    } else if (is_null($videosInfo)) {
                        $videosInfo = [];
                    }

                    foreach ($videosInfo as $video) {
                        $videoId = $video->id;
                        if (isset($allPlaylistItemsRaw[$videoId])) {
                            $duration = $this->parseIso8601Duration($video->contentDetails->duration);
                            $durationInSeconds = $this->iso8601ToSeconds($video->contentDetails->duration);
                            $allPlaylistItemsRaw[$videoId]['views'] = isset($video->statistics->viewCount) ? $video->statistics->viewCount : 'N/A';
                            $allPlaylistItemsRaw[$videoId]['hours'] = $duration['hours'];
                            $allPlaylistItemsRaw[$videoId]['minutes'] = $duration['minutes'];
                            $allPlaylistItemsRaw[$videoId]['second'] = $duration['seconds'];
                            $totalDurationSeconds += $durationInSeconds;
                        }
                    }
                }
            }
            // الآن، قم بتحويل البيانات إلى البنية النهائية المطلوبة
            $finalPlaylistItems = [];
            // فرزها حسب الترتيب المؤقت للحفاظ على الترتيب الأصلي
            usort($allPlaylistItemsRaw, function($a, $b) {
                return $a['order'] <=> $b['order'];
            });
            return [
                'items' => $allPlaylistItemsRaw,
                'total_duration_seconds' => $totalDurationSeconds,
                'total_duration_formatted' => $this->formatSecondsToHMS($totalDurationSeconds),
            ];
        } catch (Exception $e) {
            return ['error' => 'Could not retrieve playlist videos: ' . $e->getMessage()];
        }
    }

      /**
     * دالة مساعدة لتحويل مدة ISO 8601 إلى مصفوفة من الساعات، الدقائق، الثواني.
     *
     * @param string $iso8601Duration
     * @return array
     */
    protected function parseIso8601Duration(string $iso8601Duration): array
    {
        try {
            $interval = new \DateInterval($iso8601Duration);
            $hours = $interval->h;
            $minutes = $interval->i;
            $seconds = $interval->s;

            // إذا كان الفيديو أطول من 24 ساعة، DateInterval لا تضيفها إلى 'h' مباشرة
            if ($interval->days > 0) {
                $hours += $interval->days * 24;
            }

            return [
                'hours' => $hours,
                'minutes' => $minutes,
                'seconds' => $seconds,
            ];
        } catch (\Exception $e) {
            return ['hours' => 0, 'minutes' => 0, 'seconds' => 0]; // في حالة تنسيق غير صالح
        }
    }

    /**
     * دالة مساعدة لتحويل مدة ISO 8601 إلى ثواني إجمالية.
     * (تبقى كما هي)
     *
     * @param string $iso8601Duration
     * @return int
     */
    protected function iso8601ToSeconds(string $iso8601Duration): int
    {
        try {
            $interval = new \DateInterval($iso8601Duration);
            return ($interval->days * 24 * 60 * 60) +
                   ($interval->h * 60 * 60) +
                   ($interval->i * 60) +
                    $interval->s;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * دالة مساعدة لتحويل الثواني الإجمالية إلى تنسيق HH:MM:SS.
     * (تبقى كما هي)
     *
     * @param int $seconds
     * @return string
     */
    protected function formatSecondsToHMS(int $seconds): string
    {
        $h = floor($seconds / 3600);
        $m = floor(($seconds % 3600) / 60);
        $s = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $h, $m, $s);
    }
}
