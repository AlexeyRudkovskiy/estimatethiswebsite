<?php

namespace App\Http\Resources\Organisation;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganisationResource extends JsonResource
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
            'title' => $this->title,
            'users_count' => $this->users()->count(),
            'created_at' => (new Carbon($this->created_at))->toDateTimeString()
        ];
    }
}
