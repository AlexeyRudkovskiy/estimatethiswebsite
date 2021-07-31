<?php


namespace Tests\Feature\Repositories;


use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{

    use RefreshDatabase;

    protected UserRepositoryContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = resolve(UserRepositoryContract::class);
    }

    public function test_it_should_find_user_by_email()
    {
        $original = User::factory()->create([
            'email' => 'user@example.com'
        ]);

        $user = $this->repository->findByEmail('user@example.com');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($original->id, $user->id);
    }

    public function test_it_should_throw_exception_when_user_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository->findByEmail('user@example.com');
    }

    public function test_it_should_create_a_user()
    {
        $user_data = [
            'email' => 'user@example.com',
            'password' => bcrypt('hello-world'),
            'name' => 'user name'
        ];

        $this->repository->create($user_data);

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'name' => 'user name'
        ]);
    }

}
