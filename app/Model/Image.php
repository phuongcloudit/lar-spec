<?php

namespace App\Model;

use App\Model\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['title','image_name','alt','post_id'];
    public $timestamps = true;
    
    public function imgs() {
        return $this->belongsTo('App\Model\Post');
      }

}
