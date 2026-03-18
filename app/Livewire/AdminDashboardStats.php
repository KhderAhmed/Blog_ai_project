<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class AdminDashboardStats extends Component
{
    public $articlesCount;
    public $categoriesCount;
    public $usersCount;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->articlesCount = Article::count();
        $this->categoriesCount = Category::count();
        $this->usersCount = User::count();
    }

    public function render()
    {
        return view('livewire.admin-dashboard-stats');
    }
}