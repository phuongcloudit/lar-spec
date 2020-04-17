<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        "id",
        "category_id",
        "date",
        "title",
        "slug",
        "content",
        "status",
        "user_id",
    ];
    public $dates  = ['date'];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(!$model->user_id) $model->user_id = Auth::user()->id;
        });
        static::saving(function ($model) {
            if(!$model->slug){
                $model->slug = $model->title;
            }
        });
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
  
    public function category() {
      return $this->belongsTo('App\Models\Category');
    }
}
