<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = [
        "id",
        "project_category_id",
        "report_type_id",
        "title",
        "slug",
        "content",
        "date",
        "status",
        "thumbnail",
        "featured",
        "user_id",
        "author",
    ];
    protected $dates = ['date'];

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
  
    public function report_type() {
      return $this->belongsTo('App\Models\ReportType');
    }

    //attribute
    public function getUserNameAttribute(){
        return $this->user->name;
    }
    public function getStatusNameAttribute(){
        return $this->status=="publish"?"公開":"下書き";
    }
    public function scopePublish($query)
    {
        return $query->where('status', 'publish');
    }

    // public function getContentAttribute()
    // {
    //     return htmlspecialchars_decode($this->content);
    // }


    public function getTotalReportByYearAttribute(){

    //     public function getTotalPostsAttribute(){
    //         return $this->posts()->count();
    //     }

    //     $this->reports()-


    //     return number_format($this->total_donated,0,",",".");
    }
}