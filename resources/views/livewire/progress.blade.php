<div class="card-body p-2 gap-2">
    {{-- Be like water. --}}
    <div class="flex  items-center justify-between"><strong>{{$this->total}}/{{$this->completed }}</strong> <strong>100%/{{$total_percentage ?? 0}}%</strong> </div>
    <progress class="progress" value="{{$total_percentage}}" max="100"></progress>
</div>
