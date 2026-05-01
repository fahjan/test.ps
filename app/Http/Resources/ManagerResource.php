<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SchoolResource;

class ManagerResource extends JsonResource
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
            'id' => $this->id,
            'can_edit' => $this->can_edit,
            'can_delete' => $this->can_delete,
            'can_manage_managers' => $this->can_manage_managers,
            'status' => $this->status,
            'user' => new SimpleUserResource($this->user),
            'creator' => new SimpleUserResource($this->creator),
            'school' => new SchoolResource($this->school),
        ];
    }
}
