<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Project extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
    protected $fillable = [
        "id",
        "project_category_id",
        "name",
        "slug",
        "end_time",
        "thumbnail",
        "galleries",
        "content",
        "featured",
        "status",
        "user_id",
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(!$model->user_id) $model->user_id = Auth::user()->id;
        });
        static::saving(function ($model) {
            if(!$model->slug){
                $model->slug = $model->name;
            }
        });
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
  
    public function project_category() {
      return $this->belongsTo('App\Models\ProjectCategory');
    }

    public function donates() {
      return $this->hasMany('App\Models\Donate')->orderby("created_at","DESC")->orderby("id","DESC");
    }
    //scope
    public function scopePublish($query)
    {
        return $query->where('status', 'publish');
    }
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
     public function scopeNew($query)
    {
        return $query->orderby("created_at","DESC");
    }

    //attribute
    public function getUserNameAttribute(){
        return $this->user->name;
    }
    public function getTotalDonatedNumberAttribute(){
        return $this->donates()->where('state',1)->count();
    }
    public function getTotalDonatedAttribute(){
        return $this->donates()->where('state',1)->sum("money");
    }
    public function getTotalDonatedFormatAttribute(){
        return number_format($this->total_donated,0,",",".");
    }
}
