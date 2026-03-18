<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ArticleRatings;
use Illuminate\Support\Facades\Auth;

class ArticleRating extends Component
{
    public $articleId;
    public $rating = 0;

    public function mount()
    {
        $this->rating = ArticleRatings::where('user_id', Auth::id())
            ->where('article_id', $this->articleId)
            ->value('rating') ?? 0;
    }

  public function rate($value)
{
    if (!Auth::check()) return;

    ArticleRatings::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'article_id' => $this->articleId
        ],
        [
            'rating' => $value
        ]
    );

    $this->rating = $value;
}
    public function render()
    {
        return view('livewire.article-rating');
    }
}
