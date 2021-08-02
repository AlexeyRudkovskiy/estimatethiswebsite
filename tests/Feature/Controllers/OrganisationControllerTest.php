<?php


namespace Tests\Feature\Controllers;


use App\Contracts\Services\RoleServiceContract;
use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Traits\ExcludePermission;

class OrganisationControllerTest extends TestCase
{

    use RefreshDatabase;
    use ExcludePermission;

    protected User $user;
    protected Organisation $organisation;
    protected Role $role;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Organisation $organisation */
        $organisation = Organisation::factory()->create();
        /** @var User $user */
        $user = User::factory()->create();

        $this->organisation = $organisation;
        $this->user = $user;

        /** @var RoleServiceContract $roleService */
        $roleService = resolve(RoleServiceContract::class);
        $permissions = collect(array_values($roleService->getPermissionsMatrix()));
        $permissions = $permissions->flatten()->toArray();

        /** @var Role $role */
        $role = Role::factory([ 'permissions' => $permissions ])->create();
        $this->role = $role;

        $this->user->organisations()->attach($organisation->id, [
            'role_id' => $role->id
        ]);
    }

    public function test_it_should_create_new_organisation()
    {
        $organisation_data = [
            'name' => 'New Organisation'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson('/api/organisation', $organisation_data);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('organisations', [
            'name' => 'New Organisation'
        ]);
    }

    public function test_it_should_update_existing_organisation()
    {
        $update_data = [
            'name' => 'Updated Name'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/organisation/' . $this->organisation->id, $update_data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('organisations', [ 'name' => $this->organisation->name ]);
        $this->assertDatabaseHas('organisations', [ 'name' => 'Updated Name' ]);
    }

    public function test_it_should_not_allow_to_update_organisation_without_permission()
    {
        // Remove permission
        $role = $this->role;
        $role = $this->excludePermission($role, RoleService::ORGANISATION_EDIT);

        // Try to update organisation
        $update_data = [
            'name' => 'Updated Name'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/organisation/' . $this->organisation->id, $update_data);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertDatabaseHas('organisations', [ 'name' => $this->organisation->name ]);
        $this->assertDatabaseMissing('organisations', [ 'name' => 'Updated Name' ]);
    }

    public function test_it_should_delete_existing_organisation()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson('/api/organisation/' . $this->organisation->id);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('organisations', [ 'name' => $this->organisation->name ]);
    }

}
