<?php

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Donate;
use Carbon\Carbon;
class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<200; $i++){
        	$project = Project::firstOrCreate([
        			"project_category_id"	=>	rand(1,4),
        			"thumbnail"	=>	 asset("assets/images/common/project-demo-1.png"),
		        	"name"      => "#{$i} - タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル",
                    'slug'      => "project-slug-{$i}",
        			"end_time"	=>	Carbon::now()->add(rand(20,40), 'day'),
		            "content" 		=> "# ".$i." #  - テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
		            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p><p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>",
		            "recruiter_avatar"	=>	asset('assets/images/common/recruiter-avatar.png'),
		            "recruiter_name"	=>	"募集者の名前",
		            "recruiter_content"	=>	"紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テキスト紹介テ",
		            "featured"		=>	rand(0,1),
		            "status"		=>	"publish",
        			"user_id"		=>	1,
	    	]);
	    	$number = rand(10,20);
	    	for($j=1; $j<$number; $j++){
	    		Donate::create([
	    			"project_id"		=>	$project->id,
	    			"trans_code"	=>	rand(1000000,9999999),
	    			"user_id"		=>	rand(10000000,99999999),
	    			"state"			=>	1,
	    			"money"			=>	rand(100,1000),
					"payment_name"	=>	"VISA/MASTER/DINERS",
					"credit_time"	=>	Carbon::now(),
					"last_update"	=>	Carbon::now(),
					"user_mail_add"	=>	"userdemo_{$i}{$j}@demo.com",
					"user_name"		=>	"userdemo_{$i}{$j}",
					"item_code"		=>	"Spec".$project->id,
					"item_name"		=>	$project->name,
					"order_number"	=>	rand(1000000000,9999999999),
					"st_code"		=>	"10000-0000-00000-00000-00000-00000-00000",
					"pay_time"		=>	1,
					"epsilon_info"	=>	""
	    		]);
	    	}
        }
    }
}
