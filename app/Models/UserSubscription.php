<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    protected $table   = "user_subscriptions";
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getPackage()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

}
