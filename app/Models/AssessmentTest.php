<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentTest extends Model
{
    use HasFactory;

    protected $table = "assessment_tests";
    protected $guarded = [];
}
