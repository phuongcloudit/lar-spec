<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','description','slug'];
    public $timestamps = true;
  
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
    public function getTotalPostSAttribute(){
    	return $this->posts()->count();
    }
}
