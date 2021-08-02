<?php


namespace Tests\Feature\Repositories;


use App\Contracts\Repositories\OrganisationRepositoryContract;
use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganisationRepositoryTest extends TestCase
{

    use RefreshDatabase;

    protected OrganisationRepositoryContract $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = resolve(OrganisationRepositoryContract::class);
    }

    public function test_it_should_return_users_from_organisation()
    {
        /** @var Organisation $organisation */
        $organisation = Organisation::factory()->create();
        $otherUsers = User::factory()->count(5)->create();
        $organisationUsers = User::factory()->count(5)->create();

        $role = Role::factory()->create([
            'permissions' => [],
            'name' => 'Admin'
        ]);

        $organisationUsers->each(function (User $user) use ($organisation, $role) {
            $user->organisations()->attach($organisation->id, [
                'role_id' => $role->id
            ]);
        });

        $users = $this->repository->getUsers($organisation);
        $this->assertCount(5, $users);
    }

}
