<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title','author_id','donate_day_end', 'content','category_id','slug'];
    public $timestamps = true;
    
    public function author(): BelongsTo {
        return $this->belongsTo('App\Models\Category', 'author_id');
    }
  
    public function category() {
      return $this->belongsTo('App\Models\Category');
    }
    
    public function images() {
      return $this->hasMany('App\Models\Image');
    }

    public function donates() {
      return $this->hasMany('App\Models\Donate');
    }
}
