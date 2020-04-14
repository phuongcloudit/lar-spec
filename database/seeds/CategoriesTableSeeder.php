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
        Category::truncate();
        $category = Category::create([
        	'name' => '未分類',
            'description' => '',
            'slug' => 'mibunrui'
    	]);
        $category = Category::create([
            'name' => 'ヒューマン',
            'description' => '',
            'slug' => 'human'
        ]);
        $category = Category::create([
            'name' => 'ペット',
            'description' => '',
            'slug' => 'petto'
        ]);
        $category = Category::create([
            'name' => '医療',
            'description' => '',
            'slug' => 'iryou'
        ]);
        $category = Category::create([
            'name' => 'スポーツ',
            'description' => '',
            'slug' => 'supottsu'
        ]);
    }
}



