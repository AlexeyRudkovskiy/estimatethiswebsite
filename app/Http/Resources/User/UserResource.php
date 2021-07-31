<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Organisation\OrganisationResource;
use App\Models\Organisation;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class UserResource
 * @package App\Http\Resources\User
 *
 * @property Collection<Organisation> $organisations
 */
class UserResource extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'organisations' => OrganisationResource::collection($this->organisations)
        ];
    }
}
