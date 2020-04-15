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
        return $this->belongsTo('App\Models\User', 'author_id');
    }
  
    public function category() {
      return $this->belongsTo('App\Models\Category');
    }
    
    public function images() {
      return $this->hasMany('App\Models\Image');
    }

    public function donates() {
      return $this->hasMany('App\Models\Donate')->orderby("created_at","DESC")->orderby("id","DESC");
    }
    public function getAuthNameAttribute(){
        return $this->author->name;
    }
    public function getTotalDonatedAttribute(){
        return $this->donates()->where('state',1)->sum("money");
    }
    public function getTotalDonatedFormatAttribute(){
        return number_format($this->total_donated);
    }
}
