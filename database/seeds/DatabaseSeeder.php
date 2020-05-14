<?php

use Illuminate\Database\Seeder;
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
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectCategoriesTableSeeder::class); 
        $this->call(ProjectsTableSeeder::class); 
        $this->call(CategoriesTableSeeder::class); 
        $this->call(PostsTableSeeder::class); 
        $this->call(ReportTypesTableSeeder::class); 
        $this->call(ReportsTableSeeder::class); 
    }
}
