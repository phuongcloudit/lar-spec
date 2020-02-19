<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
use App\Model\User;
// use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Roles
        Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $role_admin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'usertype' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now()
            ]
        );

        $user->roles()->sync([$role_admin->id]);
    }
}
