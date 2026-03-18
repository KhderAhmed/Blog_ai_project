<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;

class ArticleCrud extends Component
{
    public $articles;
    public $categories;
    public $title = '';
    public $content = '';
    public $category_id = null;
    public $article_id = null;
    public $isEditMode = false;
    public $selectedCategory = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
    ];

    public function mount()
    {
        $this->loadArticles();
        $this->categories = Category::all();
    }

    public function loadArticles()
    {
        $query = Article::with('category')->orderBy('created_at', 'desc');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $this->articles = $query->get();
    }

    public function updatedSelectedCategory()
    {
        $this->loadArticles();
    }

    public function resetInput()
    {
        $this->title = '';
        $this->content = '';
        $this->category_id = null;
        $this->article_id = null;
        $this->isEditMode = false;
    }

    public function createArticle()
    {
        $this->validate();

        Article::create([
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
        ]);

        $this->resetInput();
        $this->loadArticles();
        session()->flash('message', '✅ تم إضافة المقال بنجاح!');
    }

    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        $this->article_id = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->category_id = $article->category_id;
        $this->isEditMode = true;
    }

    public function updateArticle()
    {
        $this->validate();

        $article = Article::findOrFail($this->article_id);
        $article->update([
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
        ]);

        $this->resetInput();
        $this->loadArticles();
        session()->flash('message', '✅ تم تحديث المقال بنجاح!');
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);

        // حذف جميع التقييمات المرتبطة
        if ($article->ratings()->exists()) {
            $article->ratings()->delete();
        }

        // إزالة جميع الـ bookmarks
        if ($article->bookmarkedByUsers()->exists()) {
            $article->bookmarkedByUsers()->detach();
        }

        // الآن حذف المقال نفسه
        $article->delete();

        $this->loadArticles();
        session()->flash('message', '✅ تم حذف المقال بنجاح!');
    }
    public function render()
    {
        return view('livewire.article-crud');
    }
}
