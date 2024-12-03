<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_number', 'type', 'capacity', 'current_occupancy', 'price', 'status' ,'floor'];

    // Relationship with Students (One to Many)
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function fees()
    {
        return $this->belongsToMany(Fee::class, 'fee_room');
    }
}
