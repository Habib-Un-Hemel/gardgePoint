<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'car_license',
        'car_engine',
        'mechanic_id',
        'appointment_date',
        'time_slot'
    ];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
