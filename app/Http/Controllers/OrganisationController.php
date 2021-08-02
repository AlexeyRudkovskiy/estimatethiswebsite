<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Http\Requests\Organisation\StoreRequest;
use App\Http\Requests\Organisation\UpdateRequest;
use App\Http\Resources\Organisation\OrganisationResource;
use App\Models\Organisation;
use App\Models\Role;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{

    /** @var OrganisationRepositoryContract */
    protected $repository;

    public function __construct(OrganisationRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OrganisationResource::collection($this->repository->paginate());
    }

    public function show(string $id)
    {
        $organisation = $this->repository->find($id);

        return OrganisationResource::make($organisation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return OrganisationResource
     */
    public function store(StoreRequest $request)
    {
        $requestData = $request->only([ 'name' ]);
        /** @var Organisation $organisation */
        $organisation = $this->repository->create($requestData);

        $organisation->users()->attach($request->user()->id, [
            'role_id' => Role::first()->id /// todo: change it with predefined role
        ]);

        return new OrganisationResource($organisation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return OrganisationResource
     */
    public function update(UpdateRequest $request)
    {
        $payload = [
            'name' => $request->name
        ];

        $organisation = $this->repository->update($request->organisation_id, $payload);

        return new OrganisationResource($organisation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $organisation_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $organisation_id)
    {
        return response()->json(
            $this->repository->delete($organisation_id)
        );
    }
}
