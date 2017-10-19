<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsDataFlow extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql_news';
    protected $table = 'news_data_flow';
    protected $fillable = ['title', 'author', 'image', 'video_cover', 'video_source', 'content', 'abstract', 'extra', 'topic_id', 'source_url', 'prepare_id', 'status', 'date'];
}
