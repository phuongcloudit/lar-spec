<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
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
        for($i=1; $i<20; $i++){
        	$post = Post::firstOrCreate([
        			"category_id"	=>	1,
		        	"title" 		=> "# ".$i." - タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル",
		            'slug' 			=> "slug-post-example-".$i,
                    "date"          =>  Carbon::now()->add(rand(-10,-30), 'day'),
		            "content" 		=> "# ".$i." - テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
		            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p><p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>",
		            "status"		=>	"publish",
        			"user_id"		=>	1
	    	]);
        }
        
    }
}
