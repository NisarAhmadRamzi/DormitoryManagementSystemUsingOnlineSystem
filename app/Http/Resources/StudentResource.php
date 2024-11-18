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
            'dob' => $this->dob,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'academic_info' => $this->academic_info,
            'room_id' => $this->room_id,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
