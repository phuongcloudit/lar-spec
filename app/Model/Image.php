<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['title','image_name','alt','post_id'];
    public $timestamps = true;
    
    // public function post(): BelongsTo {
    //     return $this->BelongsTo(Post::class, 'post_id');
    // }

}
