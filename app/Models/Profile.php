<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'office_name',
        'address',
        'order',
        'confirmed',
        'activated',
        'pickup_date',
        'image',
        'contract',
        'delivered_at'
    ];

    protected $casts = [
        'order' => 'array',
        'pickup_date' => 'array',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
