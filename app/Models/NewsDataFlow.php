<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsDataFlow extends Model
{
    protected $connection = 'mysql_news';
    protected $table = 'news_data_flow';
}
