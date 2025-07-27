<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function index()
    {

        // watch?v=cTvqNc82NJ0&list=PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt
        // $video = Youtube::getVideoInfo('cTvqNc82NJ0');


        // $channel = Youtube::getChannelById('UCk1SpWNzOs4MYmr0uICEntg');

        // // Get playlist by ID, return an STD PHP object
        // $playlist = Youtube::getPlaylistById('PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt');
        // $info = $playlist;

        // // Get playlists by multiple ID's, return an array of STD PHP objects
        // $playlists = Youtube::getPlaylistById(['PL590L5WQmH8fJ54F369BLDSqIwcs-TCfs', 'PL590L5WQmH8cUsRyHkk1cPGxW0j5kmhm0']);

        // // Get playlist by channel ID, return an array of PHP objects
        // $playlists = Youtube::getPlaylistsByChannelId('UCk1SpWNzOs4MYmr0uICEntg');

        // // Get items in a playlist by playlist ID, return an array of PHP objects
        // $lessons = Youtube::getPlaylistItemsByPlaylistId('PLDoPjvoNmBAz7wegzgoJvVJdr-WwE5Pwt');
        // foreach($lessons['results'] as $lesson) {
        //     $info = $lesson->snippet;
        //     $title = $info->title;
        //     $description = $info->description;
        //     $order = $info->position;
        //     $title = $info->thumbnails->high->url;
        //     dump($lesson);
        // }


        // $lessons = Youtube::getPlaylistItemsByPlaylistId('PLoP3S2S1qTfCUdNazAZY1LFALcUr0Vbs9');
        $data = $this->getPlaylistVideos('PLoP3S2S1qTfCUdNazAZY1LFALcUr0Vbs9');
        dd($data);
        foreach($lessons['results'] as $lesson) {
            $info = $lesson->snippet;
            // $description = $info->description;
            // $title = $info->thumbnails->high->url;
            // $this->course->lessons()->create([
            //     'order' => $info->position,
            //     'title' => $info->title,
            //     'slug' => Slug::uniqueSlug($info->title,'lessons'),
            //     'path_video' => $lesson->contentDetails->videoId
            // ]);
        }

        $courses = Course::paginate(30);
        return view('home' , compact('courses'));
    }

     /**
     * استرجاع معلومات الفيديو بواسطة ID.
     *
     * @param string $videoId
     * @return array|null
     */
    // public function getVideoInfo(string $videoId)
    // {
    //     try {
    //         // باستخدام alaouy/youtube، ببساطة استدعي getVideoInfo
    //         $video = $this->youtube->getVideoInfo($videoId);

    //         if ($video) {
    //             return [
    //                 'title' => $video->snippet->title,
    //                 'description' => $video->snippet->description,
    //                 'channelTitle' => $video->snippet->channelTitle,
    //                 'publishedAt' => $video->snippet->publishedAt,
    //                 'viewCount' => isset($video->statistics->viewCount) ? $video->statistics->viewCount : 'N/A',
    //                 'likeCount' => isset($video->statistics->likeCount) ? $video->statistics->likeCount : 'N/A',
    //                 'duration_iso' => $video->contentDetails->duration,
    //                 'duration_formatted' => $this->convertIso8601Duration($video->contentDetails->duration),
    //                 'thumbnail' => $video->snippet->thumbnails->high->url ?? null, // استخدام nullish coalescing لتجنب الأخطاء
    //             ];
    //         }
    //     } catch (Exception $e) {
    //         return ['error' => 'Could not retrieve video information: ' . $e->getMessage()];
    //     }
    //     return null;
    // }


    public function getPlaylistVideos(string $playlistId)
    {
        $allPlaylistItemsRaw = []; // لتخزين البيانات الأولية من API
        $videoIds = [];
        $totalDurationSeconds = 0;
        $nextPageToken = null;
        $orderCounter = 0; // لتعيين قيمة 'order'

        try {
            do {
                $params = [
                    'playlistId' => $playlistId,
                    'maxResults' => 50, // أقصى عدد للفيديوهات في الطلب الواحد
                ];
                if ($nextPageToken) {
                    $params['pageToken'] = $nextPageToken;
                }

                $response = Youtube::getPlaylistVideos($playlistId);
                if (!is_array($response) || !isset($response['results'])) {
                    throw new Exception('Invalid response from YouTube API');
                }
                foreach ($response['results'] as $item) {
                    $videoId = $item->contentDetails->videoId;
                    if ($videoId) {
                        $orderCounter++;
                        $videoIds[] = $videoId;
                        $allPlaylistItemsRaw[$videoId] = [
                            'order_temp' => $orderCounter, // ترتيب مؤقت للحفاظ على الترتيب الأصلي
                            'title' => $item->snippet->title,
                            'thumbnail' => $item->snippet->thumbnails->default->url ?? null,
                            'videoId' => $videoId, // حفظ ID مؤقتا للربط
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
                    $videosInfo = $this->youtube->getVideoInfo($chunk, ['part' => 'contentDetails,statistics']);

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
                return $a['order_temp'] <=> $b['order_temp'];
            });


            foreach ($allPlaylistItemsRaw as $item) {
                $finalPlaylistItems[] = [
                    'order' => $item['order_temp'],
                    'title' => $item['title'],
                    // 'slug' => \Str::slug($item['title']), // توليد slug من العنوان
                    'thumbnail' => $item['thumbnail'],
                    'path_video' => 'https://www.youtube.com/watch?v=' . $item['videoId'],
                    'views' => $item['views'],
                    'hours' => $item['hours'],
                    'minutes' => $item['minutes'],
                    'second' => $item['second'],
                ];
            }


            return [
                'items' => $finalPlaylistItems,
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
