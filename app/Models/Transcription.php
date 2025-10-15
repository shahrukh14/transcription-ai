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

    public function tasks()
    {
        return $this->hasMany(Task::class, 'transcription_id');
    }

    public function getTasksStatusAttribute(){
        $tasks = $this->tasks;

        if ($tasks->isEmpty() || $tasks->whereNotNull('status')->isEmpty()) {
            return null;
        }

        if ($tasks->every(fn($t) => $t->status === 'Completed')) {
            return 'Completed';
        }

        if ($tasks->contains(fn($t) => $t->status === 'Claimed')) {
            return 'Claimed';
        }

        if ($tasks->contains(fn($t) => $t->status === 'Unclaimed')) {
            return 'Unclaimed';
        }

        if ($tasks->contains(fn($t) => $t->status === 'Cancelled')) {
            return 'Cancelled';
        }

        return null;
    }
}
