<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="card bg-base-100  shadow-sm">
    <div class="card-body p-2" style="max-width: 800px;">
        <div id="player"></div>
    </div>
    <h1>مشغل فيديو يوتيوب</h1>
    <X-Player/>
            <div class="controls">
                <button onclick="playVideo()">تشغيل</button>
                <button onclick="pauseVideo()">إيقاف مؤقت</button>
                <button onclick="stopVideo()">إيقاف</button>
            </div>
        <div class="card-body  " style="max-width: 800px;">
            <div class="bg-white flex justify-between items-center ">
                <button class="btn btn-neutral btn-outline">
                  Next
                </button>
                <button class="btn btn-neutral btn-outline">
                  Previou
                </button>
            </div>
        </div>
  </div>
</div>




{{-- @push('scripts')
<script>
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: 'M7lc1UVf-VE',
        playerVars: {
          'playsinline': 1
        },
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
    }

    function onPlayerReady(event) {
      event.target.playVideo();
    }

    var done = false;
    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.PLAYING && !done) {
        setTimeout(stopVideo, 6000);
        done = true;
      }
    }
    function stopVideo() {
      player.stopVideo();
    }
</script>
@endpush --}}

