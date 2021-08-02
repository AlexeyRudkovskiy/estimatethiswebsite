<?php

namespace App\Http\Requests\Organisation;

use App\Http\Requests\ForOrganisationRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends ForOrganisationRequest
{

    /** @inheritDoc */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [ 'required', 'string', Rule::unique('organisations') ]
        ];
    }
}
