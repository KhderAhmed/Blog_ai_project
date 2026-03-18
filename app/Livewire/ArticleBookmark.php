<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;

class ArticleBookmark extends Component
{
    public $articleId;
    public $bookmarked = false;

    public function mount()
    {
        $this->bookmarked = Bookmarks::where('user_id', Auth::id())
            ->where('article_id', $this->articleId)
            ->exists();
    }

    public function toggle()
    {
        if (!Auth::check()) return;

        $bookmark = Bookmarks::where('user_id', Auth::id())
            ->where('article_id', $this->articleId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->bookmarked = false;
        } else {
            Bookmarks::create([
                'user_id' => Auth::id(),
                'article_id' => $this->articleId,
            ]);
            $this->bookmarked = true;
        }
    }

    public function render()
    {
        return view('livewire.article-bookmark');
    }
}


