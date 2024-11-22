<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =User::where('name','nader')->first();
        Student::create([
            'user_id'=>$user->id,
            'dob'=>'2000/01/01', 
            'gender'=>'Male', 
            'phone'=>'0796388095', 
            'academic_info'=>'student of university', 
            'room_id'=> '1',
        ]);
    }
}
