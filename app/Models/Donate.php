<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
	protected $item_prefix	=	"SPEC";

	protected $table = 'donates';
    protected $fillable = [
    	"id",
    	"post_id",
	    "money",
	    "status",
	    "eps_item_code",
	    "eps_item_name",
	    "eps_user_id",
	    "eps_user_name",
	    "eps_email",
	    "eps_order_number",
	    "eps_payment_code",
	    "eps_mission_code",
	    "eps_process_code",
	    "eps_memo1",
	    "eps_memo2",
	    "eps_redirect",
        "is_xml_error",
        "xml_error_cd",
        "xml_error_msg",
        "xml_memo1_msg",
        "xml_memo2_msg",
        "eps_result",
        "trans_code",
    ];
    protected static function boot(){
    	parent::boot();
        static::creating(function ($model) {
        	$model->status 				=	"draft";
        	$model->eps_user_id			=	rand(0,99999999);
    		$model->eps_order_number	=	time();
    		$model->eps_item_code	 	=	$model->item_prefix.$model->post->id;
    		$model->eps_item_name	 	=	$model->post->title;
    		$model->eps_memo1			=	route("post.single",["slug"	=>	$model->post->slug]);
    		$model->eps_memo1			=	route("post.single",["slug"	=>	$model->post->slug]);
        });
	}
	public function post(){
        return $this->belongsTo('App\Models\Post');
    }
}
