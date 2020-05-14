<?php

use Carbon\Carbon;
use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<50; $i++){
        	$report = Report::firstOrCreate([
                    "title"      => "#{$i} - 家族を失ったワンちゃんの保護活動",
                    'slug'      => "report-demo-{$i}",
                    "project_category_id"	=>	rand(1,4),
                    "report_type_id"	=>	rand(1,2),
        			"user_id"		=>	1,
                    "author"		=>	"黒須 花子",
                    "date"          =>  Carbon::now()->add(rand(-10,-30), 'day'),
        			"thumbnail"	=>	 asset("assets/images/common/report-thumb-demo.png"),
		            "content" 		=> "# ".$i." #  - テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
		            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p><p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>",
		            "featured"		=>	rand(0,1),
		            "status"		=>	"publish",
	    	]);
        }
    }
}
