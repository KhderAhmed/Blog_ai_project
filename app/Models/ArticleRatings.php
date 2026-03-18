<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleRatings extends Model
{
    protected $fillable = ['user_id', 'article_id', 'rating'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // علاقة بالمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
