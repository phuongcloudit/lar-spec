<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Donate;
use Carbon\Carbon;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Donate::truncate();
        for($i=1; $i<20; $i++){
        	$post = Post::create([
        			"donate_day_end"	=>	Carbon::now()->add(rand(20,40), 'day'),
        			"category_id"	=>	rand(1,4),
        			"author_id"		=>	1,
		        	"title" 		=> "# ".$i." #  - タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル",
		            'slug' 			=> $i."-title-title-title",
		            "content" 		=> "# ".$i." #  - テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
		            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p><p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>"
	    	]);
	    	$number = rand(10,100);
	    	for($j=1; $j<$number; $j++){
	    		Donate::create([
	    			"post_id"		=>	$post->id,
	    			"trans_code"	=>	rand(1000000,9999999),
	    			"user_id"		=>	rand(10000000,99999999),
	    			"state"			=>	1,
	    			"money"			=>	rand(100,1000),
					"payment_name"	=>	"VISA/MASTER/DINERS",
					"credit_time"	=>	Carbon::now(),
					"last_update"	=>	Carbon::now(),
					"user_mail_add"	=>	"userdemo_{$i}{$j}@demo.com",
					"user_name"		=>	"userdemo_{$i}{$j}",
					"item_code"		=>	"Spec".$post->id,
					"item_name"		=>	$post->title,
					"order_number"	=>	rand(1000000000,9999999999),
					"st_code"		=>	"10000-0000-00000-00000-00000-00000-00000",
					"pay_time"		=>	1,
					"epsilon_info"	=>	""
	    		]);
	    	}
        }
        
    }
}
