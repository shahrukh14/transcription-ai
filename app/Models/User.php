<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function fullName(){
        return $this->first_name." ".$this->last_name;
    }

    public function currentSubscription(){
        return $this->belongsTo(Package::class, "package_id");
    }

    public function transcriptions(){
        return $this->hasMany(Transcription::class, "user_id");
    }

    public function audioDurationWithCurrentPackage(){
        return $this->hasMany(Transcription::class, "user_id")->where('transcribe_with_package', $this->currentSubscription->id)->sum('audio_file_duration');
    }

    public function audioTrascriptionWithCurrentPackage(){
        return $this->hasMany(Transcription::class, "user_id")->where('transcribe_with_package', $this->currentSubscription->id)->count();
    }

    public function credits(){
        return $this->hasMany(Wallet::class, "user_id")->where('type', 'credit');
    }

    public function debits(){
        return $this->hasMany(Wallet::class, "user_id")->where('type', 'debit');
    }

    public function totalTransfers(){
        return $this->hasMany(Wallet::class, "user_id");
    }

    public function proofReadings(){
        return $this->hasManyThrough(
            Task::class, 
            Transcription::class,
            'user_id', // Foreign key on transcriptions table
            'transcription_id', // Foreign key on tasks table
            'id', // Primary key on users table
            'id', // Primary key on transcriptions table
        );
    }

    public function amountOnHold(){
        return $this->proofReadings()->where('tasks.status', 'Claimed')->where('tasks.payment', 'Pending')->sum('tasks.price');
    }
   
}
