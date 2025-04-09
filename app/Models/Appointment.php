<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',              
        'phone', 
        'gender',
        'service',
        'appointment_date',
        'appointment_time',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
