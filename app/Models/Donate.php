<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
	protected $item_prefix	=	"SPEC";

	protected $table = 'donates';
    protected $fillable = [
        "id",
        "project_id",
        "trans_code",
        "user_id",
        "state",
        "money",
        "payment_name",
        "credit_time",
        "last_update",
        "user_mail_add",
        "user_name",
        "item_code",
        "item_name",
        "order_number",
        "st_code",
        "pay_time",
        "epsilon_info"
    ];
    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $project = $model->project;
            $project->money = $project->TotalDonated;
            $project->donated = $project->TotalDonatedNumber;
            $project->save();
        });
    }
	public function project(){
        return $this->belongsTo('App\Models\Project');
    }
}
