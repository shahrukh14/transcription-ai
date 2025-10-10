@forelse($transcriptions as $key=>$transcript)
    <tr class="tableRow">
        <td>{{$key + 1}}</td>
        <td>
            <a href="{{ route('user.transcription.edit',$transcript->id) }}" title="{{ $transcript->audio_file_original_name }}">
                {{ Str::limit($transcript->audio_file_original_name, 20, '...') }}
            </a>
        </td>
        <td>
            <a href="{{ route('user.transcription.edit',$transcript->id) }}" title="{{ $transcript->transcription_from_api }}">
                {{ Str::limit($transcript->transcription_from_api, 45, '...') }}
            </a>
        </td>
        <td>
            @if($transcript->status == 0)
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            @else
                <span class="badge rounded-pill bg-success">Transcribed</span>
            @endif
        </td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ route('user.transcription.view',$transcript->id) }}" title="View Transcription" class="btn btn-outline-success"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('user.transcription.edit',$transcript->id) }}" title="Edit" class="btn btn-outline-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="{{ route('user.transcription.delete',$transcript->id) }}" title="Delete" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
            </div>
        </td>
    </tr>
@empty
    <tr class="text-center mt-4">
        <th colspan="5">No data found</th>
    </tr>
@endforelse