<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?? 'مشروع المدوّنة' }}</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="//unpkg.com/alpinejs" defer></script>
@livewireStyles

<style>
:root {
    --bg: linear-gradient(135deg,#e0f2fe,#bae6fd);
    --glass-bg: rgba(255,255,255,0.45);
    --glass-border: rgba(0,0,0,0.1);
    --text-color: #000;
}
.dark {
    --bg: linear-gradient(135deg,#0f172a,#1e293b);
    --glass-bg: rgba(255,255,255,0.08);
    --glass-border: rgba(255,255,255,0.2);
    --text-color: #fff;
}
body {
    font-family: Tajawal, sans-serif;
    background: var(--bg);
    color: var(--text-color);
    min-height: 100vh;
}
.glass {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    border-radius: 1.4rem;
    transition: 0.3s;
}
#theme-switch {
    width: 55px;
    height: 28px;
    border-radius: 50px;
    background: rgba(255,255,255,0.3);
    cursor: pointer;
    position: relative;
}
#theme-circle {
    width: 24px;
    height: 24px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    right: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}
.dark #theme-circle {
    transform: translateX(-27px);
}
</style>
</head>

<body class="flex flex-col min-h-screen">

<!-- HEADER -->
<header class="glass shadow-lg px-6 py-4 flex justify-between items-center">
    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-sky-400 to-indigo-500 bg-clip-text text-transparent">
        📝 مشروع المدوّنة
    </h1>

    <div class="flex items-center gap-4">
        <nav class="flex gap-4 items-center font-bold">
            <a href="/">الرئيسية</a>
            <a href="/blog">المدونة</a>

            @auth
            <div x-data="{open:false}" class="relative">
                <button @click="open=!open">{{ Auth::user()->name }}</button>
                <div x-show="open" @click.away="open=false" class="absolute right-0 mt-2 bg-white dark:bg-gray-800 rounded shadow p-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="block w-full text-right">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
            @else
                <a href="/login">دخول</a>
            @endauth
        </nav>

        <!-- Theme Switch -->
        <div id="theme-switch">
            <div id="theme-circle">🌞</div>
        </div>
    </div>
</header>

<!-- SEARCH -->
<div class="flex justify-center my-6">
    <form action="{{ route('blog.search') }}" method="GET"
          class="glass px-6 py-3 flex gap-3 w-full max-w-xl">
        <input name="q" class="w-full bg-transparent outline-none" placeholder="ابحث عن مقال...">
        <button type="submit">🔍</button>
    </form>
</div>

<!-- BLOG LIST -->
<section class="max-w-5xl mx-auto space-y-8 p-4">
@foreach($blogs as $blog)
<div class="glass p-6 flex flex-col min-h-[420px]">

    <h3 class="text-2xl font-bold">{{ $blog->title }}</h3>

    <p class="text-sm opacity-70 mt-1">
        {{ optional($blog->created_at)->format('Y-m-d') }} • {{ $blog->read_time ?? 1 }} دقيقة
    </p>

    <p class="mt-4 leading-7">{{ Str::limit(strip_tags($blog->content), 200) }}</p>

    <div class="mt-auto flex flex-col gap-3">

        <a href="{{ route('blog.show', $blog->id) }}"
           class="bg-indigo-600 text-white py-2 rounded text-center font-bold">
           اقرأ المزيد →
        </a>
<a href="{{ route('blog.downloadPdf', $blog->id) }}"
   class="bg-gray-600 text-white py-2 rounded text-center">
   تحميل PDF
</a>

        @auth
        <livewire:article-summary :blogId="$blog->id" wire:key="summary-{{ $blog->id }}" />
        <livewire:article-bookmark :articleId="$blog->id" wire:key="bookmark-{{ $blog->id }}" />
        <livewire:article-rating :articleId="$blog->id" wire:key="rating-{{ $blog->id }}" />
        @else
        <button onclick="alert('سجّل دخولك أولاً')" class="bg-gray-400 text-white py-2 rounded">
            حفظ / تقييم / تلخيص
        </button>
        @endauth

        <!-- مقالات مقترحة -->
        <div class="mt-6 border-t border-gray-300 dark:border-gray-700 pt-4">
            <h4 class="font-bold mb-2">مقالات مقترحة:</h4>
            <ul class="list-disc list-inside text-sm">
                @foreach($blog->related() as $rel)
                <li><a href="{{ route('blog.show', $rel->id) }}" class="text-blue-600 hover:underline">{{ $rel->title }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endforeach
</section>

<footer class="glass text-center p-4 mt-auto">
    © 2025 مشروع المدوّنة
</footer>

@livewireScripts
<script>
feather.replace();

// Theme Switch
const themeSwitch = document.getElementById('theme-switch');
const circle = document.getElementById('theme-circle');
function setTheme(mode) {
    document.documentElement.classList.toggle('dark', mode==='dark');
    circle.textContent = mode==='dark' ? '🌙' : '🌞';
    document.cookie = "theme="+mode+";path=/;max-age=31536000";
}
function getTheme() {
    const match = document.cookie.match(/theme=(dark|light)/);
    return match ? match[1] : null;
}
const savedTheme = getTheme() || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark':'light');
setTheme(savedTheme);
themeSwitch.addEventListener('click', ()=>{
    setTheme(document.documentElement.classList.contains('dark') ? 'light':'dark');
});

// منع النسخ وPrintScreen
document.addEventListener('copy', e=> e.preventDefault());
document.addEventListener('cut', e=> e.preventDefault());
document.addEventListener('contextmenu', e=> e.preventDefault());
document.addEventListener('keydown', e=>{
    if(e.key==='PrintScreen') alert('السكرين شوت ممنوع');
    if(e.ctrlKey && ['c','x'].includes(e.key)) e.preventDefault();
});
</script>

</body>
</html>
