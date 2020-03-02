<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
