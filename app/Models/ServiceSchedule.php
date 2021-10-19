<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

use DateTimeInterface;


class ServiceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'waiting_for_call',
        'call_scheduled_at',
    ];

    protected $casts = [
        'call_scheduled_at' => 'datetime',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format("Y-m-d - H:i");
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
