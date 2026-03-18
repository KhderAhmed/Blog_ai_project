# 📝 Blog System (Laravel 12)

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge\&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-Dynamic-blue?style=for-the-badge)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-Styled-38B2AC?style=for-the-badge\&logo=tailwind-css)
![Status](https://img.shields.io/badge/Status-Production--Ready-brightgreen?style=for-the-badge)

A modern, full-featured blog platform built with **Laravel 12**, **Livewire**, and **TailwindCSS**.
Designed for performance, clean UI, and Arabic content support.

---

## 🚀 Features

✨ Article Management (CRUD)
🏷️ Categories System (Livewire)
⭐ Rating System (per user)
🔖 Bookmark (Read Later)
📄 Export Articles as PDF (Arabic Supported)
🌙 Dark / Light Mode
⚡ Real-time UI (Livewire)

---

## 📸 Preview

> Add screenshots here later
> `/screenshots/home.png`
> `/screenshots/article.png`

---

## 🛠️ Tech Stack

| Tech       | Usage             |
| ---------- | ----------------- |
| Laravel 12 | Backend Framework |
| Livewire   | Dynamic UI        |
| Tailwind   | Styling           |
| SQLite     | Database          |
| DomPDF     | PDF Export        |

---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/blog-system.git
cd blog-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## 📄 PDF Export (Arabic Ready)

### Install Package

```bash
composer require barryvdh/laravel-dompdf
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```

---

### Arabic Font Setup

```bash
mkdir -p storage/fonts
```

Place fonts:

```
storage/fonts/Cairo-Regular.ttf
storage/fonts/Cairo-Bold.ttf
```

---

### dompdf Config

```php
'font_dir' => storage_path('fonts/'),
'font_cache' => storage_path('fonts/'),

'fonts' => [
    'cairo' => [
        'R' => 'Cairo-Regular.ttf',
        'B' => 'Cairo-Bold.ttf',
    ],
],
```

---

### Blade Example

```blade
<body style="font-family: Cairo; direction: rtl;">
<h1>{{ $blog->title }}</h1>
<p>{!! nl2br(e($blog->content)) !!}</p>
</body>
```

---

### Controller

```php
use Barryvdh\DomPDF\Facade\Pdf;

public function downloadPdf($id)
{
    $blog = Article::findOrFail($id);
    $pdf = Pdf::loadView('pdf.blog', compact('blog'));
    return $pdf->download('article.pdf');
}
```

---

## ⭐ Rating Logic

* One rating per user
* Prevents duplicates via unique constraint
* Uses `updateOrCreate`

---

## 🔖 Bookmark System

* Save articles per user
* Easy retrieval

---

## 🌙 Dark Mode

* Tailwind-based
* Smooth toggle

---

## ⚠️ Common Issues

### Arabic Text Broken (????)

✔ Fix: Use Cairo font
✔ Ensure UTF-8 encoding

---

### PDF Not Downloading

✔ Check route parameter
✔ Ensure correct controller

---

### Livewire Not Working

```bash
php artisan livewire:discover
```

---

## 📁 Project Structure

```
app/
 ├── Livewire/
 ├── Models/
resources/
 ├── views/
 ├── views/pdf/
config/
 ├── dompdf.php
```

---

## 👨‍💻 Author

Built with ❤️ using Laravel ecosystem.

---

## ⭐ Support

If you like this project:

👉 Give it a star on GitHub
👉 Fork and improve it

---

## 🔥 Future Improvements

* AI Article Summary
* Recommendation System
* SEO Optimization
* API Version

---

> Clean code. Real-time UI. Arabic-ready PDF. 🚀
