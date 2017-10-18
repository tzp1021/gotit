<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTopic extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql_news';
    protected $table = 'news_topic';
    protected $fillable = ['name', 'icon_url', 'abstract', 'status', 'cate_id', 'sort', 'insert_time', 'news_update_time'];
}
