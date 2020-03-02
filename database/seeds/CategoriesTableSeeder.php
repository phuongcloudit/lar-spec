<?php

use Illuminate\Database\Seeder;

use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
        	'name' => 'uncategorized',
            'description' => 'All post/project uncategorized',
            'slug' => 'uncategorized'
    	]);
    }
}
