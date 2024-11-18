<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['student_id', 'description', 'status'];

    // Relationship with Student (Many to One)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
