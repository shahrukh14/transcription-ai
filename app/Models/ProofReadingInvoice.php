<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProofReadingInvoice extends Model
{
    use HasFactory;
    protected $table = "proof_reading_invoices";
    protected $guarded = [];

    public function proofReader(){
        return $this->belongsTo(ProofReader::class);
    }
}
