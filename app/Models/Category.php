<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
    	"id",
    	"name",
        "slug",
        "image",
        "description",
    ];

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
    public function getTotalPostsAttribute(){
    	return $this->posts()->count();
    }
}
