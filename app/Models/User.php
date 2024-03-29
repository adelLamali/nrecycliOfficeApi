<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Profile;
use App\Models\Recyclables;
use App\Models\Transaction;
use App\Models\Credentials;
use App\Models\ServiceSchedule;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function recyclables()
    {
        return $this->hasOne(Recyclables::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function credentials()
    {
        return $this->hasOne(Credentials::class);
    }

    public function schedule() 
    {
        return $this->hasOne(ServiceSchedule::class);
    }
    
}
