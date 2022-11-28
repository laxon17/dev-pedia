<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Dimitrije Borcanin',
            'email' => 'dime@example.com',
            'username' => 'dime95',
            'password' => 'Dime!95',
            'role' => User::ROLE_ADMINISTRATOR
        ]);

        User::factory()->create([
            'name' => 'Lazar Lalovic',
            'email' => 'laxon@example.com',
            'username' => 'laxon00',
            'password' => 'Laxon!00',
            'role' => User::ROLE_ADMINISTRATOR
        ]);

        Post::factory(10)->create();
    }
}
