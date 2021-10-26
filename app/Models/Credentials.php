<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use DateTimeInterface;

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
        'quotation_number',
        'to_be_delivered_at',
    ];

    protected $casts = [
        'to_be_delivered_at' => 'datetime',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class); 
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format("Y-m-d");
    }

}
