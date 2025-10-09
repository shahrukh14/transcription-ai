<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProofReader extends Authenticatable
{
    use HasFactory;
    
    protected $table = "proof_readers";
    protected $guarded = [];

    public function fullName(){
        return $this->first_name." ".$this->last_name;
    }
}
