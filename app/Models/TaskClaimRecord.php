<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskClaimRecord extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = "task_claim_records";
    protected $guarded = [];

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
    
    public function proofReader(){
        return $this->belongsTo(ProofReader::class, 'proof_reader_id');
    }
}
