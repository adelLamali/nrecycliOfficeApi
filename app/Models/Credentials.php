<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Credentials extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'registre',
        'nif',
        'nis',
        'rip',
        'invoice_number',
        'to_be_delevered_at',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
