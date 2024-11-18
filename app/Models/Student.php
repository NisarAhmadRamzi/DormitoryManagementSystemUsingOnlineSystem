<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'dob', 'gender', 'phone', 'academic_info', 'room_id'];

    // Relationship with User (One to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Room (Many to One)
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relationship with Fees (One to Many)
    // public function fees()
    // {
    //     return $this->hasMany(Fee::class);
    // }

    // Relationship with Complaints (One to Many)
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    // // Relationship with Visitors (One to Many)
    // public function visitors()
    // {
    //     return $this->hasMany(Visitor::class);
    // }
}

