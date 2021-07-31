<?php


namespace Tests\Feature\Controllers;


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_should_sign_in_with_correct_credentials()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([ 'token', 'user' ]);
    }

    public function test_it_should_throw_validation_error()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'user2@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([ 'message' ]);
    }

    public function test_it_should_throw_error_when_password_is_incorrect()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'password2'
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonStructure([ 'message' ]);
    }

    public function test_it_should_create_a_user()
    {
        $user_data = [
            'email' => 'user@example.com',
            'password' => 'password',
            'name' => 'admin'
        ];

        $response = $this->postJson('/api/register', $user_data);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([ 'token', 'user' ]);
    }

    public function test_it_should_not_create_a_user_when_email_is_already_registered()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);

        $user_data = [
            'email' => 'user@example.com',
            'password' => 'password',
            'name' => 'admin'
        ];

        $response = $this->postJson('/api/register', $user_data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertSee('email');
    }

    public function test_it_should_return_current_user_information()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user1, 'sanctum')
            ->getJson('/api/me');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($user1->id);
        $response->assertDontSee($user2->id);

        $response = $this->actingAs($user2, 'sanctum')
            ->getJson('/api/me');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($user2->id);
        $response->assertDontSee($user1->id);
    }

}
