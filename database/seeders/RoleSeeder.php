<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'name' => 'Owner',
            'permissions' => [
                'project' => [
                    'create' => true,
                    'update' => true,
                    'delete' => true,
                    'view'   => true
                ]
            ]
        ]);
    }
}
