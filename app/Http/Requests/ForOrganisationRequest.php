<?php


namespace App\Http\Requests;


use App\Models\Organisation;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ForOrganisationRequest
 * @package App\Http\Requests
 *
 * @property string $organisation_id
 */
abstract class ForOrganisationRequest extends FormRequest
{

    protected string $permission;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = request()->user();

        return $user->isAllowed($this->permission);
    }

    public function getOrganisation(): Organisation
    {
        return Organisation::firstOrFail($this->organisation_id);
    }

}
