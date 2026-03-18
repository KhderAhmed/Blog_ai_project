<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryForm extends Component
{
    public $name = '';
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
    ];

    public function submit()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name), // يحول الاسم إلى slug صالح
        ]);
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.category-form', compact('categories'));
    }
}
