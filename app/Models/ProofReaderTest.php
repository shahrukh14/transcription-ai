<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofReaderTest extends Model
{
    protected $table = "proof_reader_tests";
    protected $guarded = [];
    use HasFactory;

    public function assessment(){
        return $this->belongsTo(AssessmentTest::class, 'assessment_tests_id');
    }
}
