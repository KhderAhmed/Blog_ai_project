<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        $blogs = Article::query()
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->latest()
            ->get();

        return view('blog.index', [
            'blogs' => $blogs,
            'title' => 'نتائج البحث: ' . $query
        ]);
    }
    public function blog()
    {
        $blogs = Article::latest()->get();
        return view('blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Article::with('category')->findOrFail($id); // جلب المقال مع الفئة

        // سجل القراءة
        if (auth()->check()) {
            auth()->user()->views()->syncWithoutDetaching([$blog->id]);
        }

        return view('blog.show', compact('blog'));
    }




    public function downloadPdf($id)
    {
        $blog = Article::findOrFail($id);

        $pdf = Pdf::loadView('blog.pdf', compact('blog'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("{$blog->title}.pdf");
    }
}
