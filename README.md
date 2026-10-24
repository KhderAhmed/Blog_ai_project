# 📝 Blog System

A modern Laravel blog platform focused on article management, categories, ratings, bookmarks, admin flows, and PDF export.

## Features
- Article CRUD
- Category management
- User bookmarks and article views
- Ratings and read-time logic
- Admin authentication
- Arabic-friendly content and PDF export

## Tech Stack
- Laravel 12
- Livewire
- Tailwind CSS
- SQLite
- DomPDF

## Installation
```bash
git clone https://github.com/KhderAhmed/Blog_ai_project.git
cd Blog_ai_project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## Admin login
Default admin account is created by the seeder:
- Email: admin@example.com
- Password: 12345678

## Notes
This project is a strong starting point for a blog application, but it should still be hardened with tests and production-level checks before deployment.
