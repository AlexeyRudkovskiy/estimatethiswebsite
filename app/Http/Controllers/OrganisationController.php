<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Http\Requests\Organisation\StoreRequest;
use App\Http\Resources\Organisation\OrganisationCollection;
use App\Http\Resources\Organisation\OrganisationResource;
use App\Models\Organisation;
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
        $requestData = $request->only(['title']);
        $organisation = $this->repository->create($requestData);
        return new OrganisationResource($organisation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        //
    }
}
