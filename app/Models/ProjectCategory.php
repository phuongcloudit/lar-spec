<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ProjectCategory extends Model
{
    protected $table = 'project_categories';
    protected $fillable = [
    	"id",
    	"name",
        "slug",
        "image",
        "description",
    ];

    public function projects() {
        return $this->hasMany('App\Models\Project');
    }
    public function getTotalProjectsAttribute(){
    	return $this->projects()->count();
    }
}
