<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'specialty', 'experience'];

    public function appointmentsToday()
    {
        return $this->hasMany(Appointment::class)
            ->whereDate('appointment_date', now()->toDateString());
    }
}

