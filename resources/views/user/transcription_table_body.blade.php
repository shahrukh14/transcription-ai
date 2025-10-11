@forelse($transcriptions as $key=>$transcript)
@php
    $timeInSeconds  = $transcript->audio_file_duration;
    $minutes        = floor($timeInSeconds / 60);
    $seconds        = $timeInSeconds - ($minutes * 60);
    $roundedSeconds = round($seconds);
    $formattedTime  = "{$minutes}m {$roundedSeconds}s";
@endphp
    <tr class="tableRow">
        <td>
            <a href="{{ route('user.transcription.view',$transcript->id) }}" title="{{ $transcript->audio_file_original_name }}">
                {{ Str::limit($transcript->audio_file_original_name, 50, '...') }}
            </a>
        </td>
        <td> {{date('d M Y, h:i A', strtotime($transcript->created_at))}} </td>
        <td> {{ $formattedTime }} </td>
        <td>
            @if($transcript->status == 0)
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            @else
                <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis" style="font-size: 20px"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('user.transcription.view',$transcript->id) }}" title="View Transcription">
                        <i class="fa-solid fa-file-lines"></i><span> Open Transcript</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('user.transcription.pdf.download',$transcript->id) }}" title="PDF Download">
                        <i class="fa-solid fa-file-pdf"></i><span> PDF Download</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('user.transcription.docx.download',$transcript->id) }}" title="Word Download">
                        <i class="fa-solid fa-file-word"></i><span> Word Download</span>
                    </a>
                    <a class="dropdown-item renameFileButton" href="#" title="Rename Filed" data-name="{{$transcript->audio_file_original_name}}" data-id="{{$transcript->id}}">
                        <i class="fa-solid fa-pen-to-square"></i><span> Rename File</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('user.transcription.delete',$transcript->id) }}" title="Delete">
                        <i class="fa-solid fa-trash"></i><span> Delete</span>
                    </a>
                </div>
            </div>
        </td>
    </tr>
@empty
    <tr class="text-center mt-4">
        <th colspan="5">No data found</th>
    </tr>
@endforelse