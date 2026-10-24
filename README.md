# 📝 Blog System (Laravel 12)

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-Dynamic-blue?style=for-the-badge)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-Styled-38B2AC?style=for-the-badge&logo=tailwind-css)
![Status](https://img.shields.io/badge/Status-Production--Ready-brightgreen?style=for-the-badge)

A modern full-featured blog platform built with Laravel 12, Livewire, and Tailwind CSS.
Designed for performance, clean UI, and Arabic content support.

---

## 🚀 Features

- Article management (CRUD)
- Categories system (Livewire)
- Rating system (per user)
- Bookmark system (read later)
- PDF export for articles
- Dark / light mode
- Real-time UI via Livewire
- Arabic content support

---

## 🛠️ Tech Stack

| Tech | Usage |
| --- | --- |
| Laravel 12 | Backend framework |
| Livewire | Dynamic UI |
| Tailwind CSS | Styling |
| SQLite | Database |
| DomPDF | PDF export |

---

## ⚙️ Installation

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

---

## 🔐 Admin Login

Default admin account created by the seeder:

- Email: admin@example.com
- Password: 12345678

---

## 📄 PDF Export (Arabic Ready)

This project includes PDF generation for blog articles and supports Arabic-friendly layout through the Dompdf configuration.

---

## ⭐ Project Notes

This project is a strong blog application starter and includes the main features expected from a modern Laravel blog.
It still benefits from additional production hardening, including feature tests and more robust validation/security checks.

---

## 📁 Project Structure

```text
app/
├── Http/
├── Livewire/
├── Models/
├── Python/
config/
database/
public/
resources/
routes/
tests/
```

---

## 👨‍💻 Author

Built with Laravel and a focus on modern blog workflows.

---

## 🔥 Future Improvements

- AI article summary
- Personalized recommendations
- SEO enhancements
- API versioning
- More coverage with automated tests
