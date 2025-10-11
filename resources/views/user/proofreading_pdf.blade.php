<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$task->transcription->audio_file_original_name}}</title>
    <style>
        @font-face {
            font-family: 'NotoSansDevanagari';
            src: url("{{ resource_path('fonts/NotoSansDevanagari-Regular.ttf') }}") format('truetype');
        }
        body{
            font-family: 'NotoSansDevanagari', sans-serif;
            margin-top:50px;
            margin-left:50px;
            margin-right:50px;
        }
    </style>
</head>
<body>
    <h3 style="text-align: center; margin-bottom:50px;">{{$task->transcription->audio_file_original_name}}</h3>
    @php $speakerMap = []; $speakerCounter = 1; @endphp
    @foreach (json_decode($task->transcription_segments)??[] as $segment)
        @php
            if (!isset($speakerMap[$segment->speaker])) {
                $speakerMap[$segment->speaker] = 'Speaker ' . $speakerCounter++;
            }
            $timeInSeconds  = $segment->start;
            $minutes        = floor($timeInSeconds / 60);
            $seconds        = $timeInSeconds - ($minutes * 60);
            $roundedSeconds = round($seconds);
            $formattedTime  = sprintf("%02d:%02d", $minutes, $roundedSeconds);
        @endphp
        @if($request->speaker == "true")<span style="font-weight: bold;">{{ $speakerMap[$segment->speaker] }}</span>@endif
        @if($request->timestamp == "true")<span style="color: #717272">({{ $formattedTime}})</span>@endif
        <p data-start="{{$segment->start}}">{{$segment->text}}</p>
    @endforeach
</body>
</html>