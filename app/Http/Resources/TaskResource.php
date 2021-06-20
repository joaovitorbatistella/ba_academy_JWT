<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => (integer) $this->id,
            'label'       => (string)  $this->label,
            'is_complete' => (integer) $this->is_complete,
            'created_at'  => (string)  $this->created_at,
            'updated_at'  => (string)  $this->updatedet_at,
        ];
    }
}
