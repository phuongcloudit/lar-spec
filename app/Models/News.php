<?php

namespace App\Model;

use App\Model\News;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['date_time','news_type','news_content'];
    public $timestamps = true;
}
