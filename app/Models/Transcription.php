<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcription extends Model
{
    use HasFactory;

    protected $table = "transcriptions";
    protected $guarded = [];
    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getPackage()
    {
        return $this->belongsTo(Package::class, 'transcribe_with_package');
    }
}
