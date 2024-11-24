<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        // Return the student data in a structured format
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'name' => $this->name,
            'f_name' => $this->f_name,
            'last_name' => $this->last_name,
            'from' => $this->from,
            'dob' => $this->dob,
            'id_number' => $this->id_number,
            'academic_info' => $this->academic_info,
            'phone' => $this->phone,
            'registration_date' => $this->registration_date,
            'registration_deadline' => $this->registration_deadline,
            'gender' => $this->gender,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
