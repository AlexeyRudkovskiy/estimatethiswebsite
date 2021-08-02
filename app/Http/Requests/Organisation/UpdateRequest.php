<?php

namespace App\Http\Requests\Organisation;

use App\Http\Requests\ForOrganisationRequest;
use App\Services\RoleService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Organisation
 *
 * @property string $name
 */
class UpdateRequest extends ForOrganisationRequest
{

    protected string $permission = RoleService::ORGANISATION_EDIT;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:organisations,name,' . $this->organisation_id
        ];
    }
}
