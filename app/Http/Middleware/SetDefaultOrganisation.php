<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class SetDefaultOrganisation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $organisationId = $request->route('organisation_id', null);

        if ($organisationId === null) {
            abort(500);
        }

        /** @var User $user */
        $user = $request->user();
        $user->makeDefaultOrganisation($organisationId);

        return $next($request);
    }
}
