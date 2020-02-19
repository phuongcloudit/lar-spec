<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','author_id','donate_day_end', 'content','category_id'];
    public $timestamps = true;
    
    public function author(): BelongsTo {
        return $this->belongsTo('App\Model\Category', 'author_id');
    }
  
    public function category() {
      return $this->belongsTo('App\Model\Category');
    }
    
    public function images() {
      return $this->hasMany('App\Model\Image');
    }
}
