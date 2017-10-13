<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTopic extends Model
{
    protected $connection = 'mysql_news';
    protected $table = 'news_topic';
}
