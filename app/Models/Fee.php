<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    
    protected $fillable = ['student_id', 'amount', 'status', 'due_date', 'paid_at'];

    // Relationship with Student (Many to One)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    // Many-to-Many relationship with rooms
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'fee_room');
    }
}
