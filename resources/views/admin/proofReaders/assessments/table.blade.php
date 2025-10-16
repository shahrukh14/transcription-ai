@if(count($tests))
    @foreach($tests as $test)
        @php
            $timeInSeconds  = $test->audio_duration;
            $hours          = floor($timeInSeconds / 3600);
            $minutes        = floor(($timeInSeconds % 3600) / 60);
            $seconds        = $timeInSeconds % 60;

            $audioDuration  = '';
            if ($hours > 0) {
                $audioDuration .= "{$hours}hr ";
            }
            if ($minutes > 0 || $hours > 0) {
                $audioDuration .= "{$minutes}min ";
            }
            $audioDuration .= "{$seconds}sec";

            $testDurationInSeconds = ((int)$test->test_duration * 60);
            $test_hours          = floor($testDurationInSeconds / 3600);
            $test_minutes        = floor(($testDurationInSeconds % 3600) / 60);
            $test_seconds        = $testDurationInSeconds % 60;

            $testDuration  = '';
            if ($test_hours > 0) {
                $testDuration .= "{$test_hours}hr ";
            }
            if ($test_minutes > 0 || $test_hours > 0) {
                $testDuration .= "{$test_minutes}min ";
            }
            if ($test_seconds > 0) {
                $testDuration .= "{$test_seconds}sec";
            }
        @endphp
        <tr>
            <td>{{$test->name}}</td>
            <td>{{ Str::limit($test->audio_file_original_name, 50, '...') }}</td>
            <td>
                @if ($test->assessment_type == 1)
                    <span class="badge rounded-pill badge-light-primary me-1">Assessment 1</span>
                @else
                    <span class="badge rounded-pill badge-light-info me-1">Assessment 2</span>
                @endif
            </td>
            <td>{{ ucfirst($test->audio_language) }}</td>
            <td>{{ $audioDuration }}</td>
            <td>{{ $testDuration }}</td>
            <td>{{ date('d M Y, H:i A', strtotime($test->created_at))}}</td>
            <td>
                @if ($test->status == 1)
                    <span class="badge rounded-pill badge-light-success me-1">Active</span>
                @else
                    <span class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                @endif
            </td>
            <td>
                <button type="button" 
                    class="btn btn-sm btn-outline-primary editBtn"
                    data-id="{{ $test->id }}"
                    data-name="{{ $test->name }}"
                    data-audio_language="{{ $test->audio_language }}"
                    data-test_duration="{{ $test->test_duration }}"
                    data-assessment_type="{{ $test->assessment_type }}"
                    data-status="{{ $test->status }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editTestModal">
                    <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>
    @endforeach
@else
<tr class="text-center mt-4">
    <th colspan="6">No data found</th>
</tr>
@endif