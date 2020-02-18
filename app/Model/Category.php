<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','description'];
    public $timestamps = true;


    // public function posts() {   
    //      return $this->hasMany(Post::class, 'category_id');
    // }
    // public function posts() {
    //     return $this->hasMany('Post');
    // }
}
