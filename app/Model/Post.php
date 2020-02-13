<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    
    protected $table = 'posts';
    protected $fillable = ['title','author_id','donate_money','donate_day_end', 'content','category_id'];
    public $timestamps = true;
    
    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
