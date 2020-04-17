<?php

use Illuminate\Database\Seeder;

use App\Models\ProjectCategory;
class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ProjectCategory::firstOrCreate([
            'name' => 'ヒューマン',
            "image" =>  asset('assets/images/common/category-human.png'),
            'description' => '',
            'slug' => 'human'
        ]);
        $category = ProjectCategory::firstOrCreate([
            'name' => 'ペット',
            "image" =>    asset('assets/images/common/category-petto.png'),
            'description' => '',
            'slug' => 'petto'
        ]);
        $category = ProjectCategory::firstOrCreate([
            'name' => '医療',
            "image" =>    asset('assets/images/common/category-iryou.png'),
            'description' => '',
            'slug' => 'iryou'
        ]);
        $category = ProjectCategory::firstOrCreate([
            'name' => 'スポーツ',
            "image" =>    asset('assets/images/common/category-supottsu.png'),
            'description' => '',
            'slug' => 'supottsu'
        ]);
    }
}
