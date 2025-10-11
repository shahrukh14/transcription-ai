<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";
    protected $guarded = [];

    public function transcription()
    {
        return $this->belongsTo(Transcription::class, 'transcription_id');
    }
    public function getProofreader()
    {
        return $this->belongsTo(ProofReader::class, 'claimed_by', 'id');
    }
}

