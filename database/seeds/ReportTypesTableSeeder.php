<?php

use Illuminate\Database\Seeder;

use App\Models\ReportType;
class ReportTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reportType = ReportType::firstOrCreate([
            'name' => '活動報告',
            'description' => '',
            'slug' => 'activity'
        ]);
        $reportType = ReportType::firstOrCreate([
            'name' => '事務局より',
            'description' => '',
            'slug' => 'secretariat'
        ]);
    }
}
