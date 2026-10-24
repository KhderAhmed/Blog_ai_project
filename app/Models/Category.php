<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'badge'];

    protected function readTime(): Attribute
    {
        return new Attribute(
            get: function () {
                $text = strip_tags($this->content);
                preg_match_all('/\p{L}+/u', $text, $matches);
                $words = count($matches[0]);

                return max(1, (int) ceil($words / 200));
            }
        );
    }

    public function ratings()
    {
        return $this->hasMany(ArticleRatings::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }

    public function related()
    {
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->take(3)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::deleting(function ($article) {
            $article->ratings()->delete();
            $article->bookmarkedByUsers()->detach();
        });
    }
}
