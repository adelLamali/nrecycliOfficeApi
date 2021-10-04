<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet',
        'rigid_plastic',
        'glass',
        'paper',
        'aluminium',
        'oil',
        'rate',
        'destination',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
