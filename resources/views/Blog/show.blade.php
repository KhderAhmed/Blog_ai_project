<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $blog->title ?? 'مشروع المدوّنة' }}</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="//unpkg.com/alpinejs" defer></script>
@livewireStyles

<style>
:root {
  --bg: linear-gradient(135deg,#e0f2fe,#bae6fd);
  --text: #1e293b;
  --glass-bg: rgba(255,255,255,0.45);
  --glass-border: rgba(0,0,0,0.1);
}
.dark {
  --bg: linear-gradient(135deg,#0f172a,#1e293b);
  --text: #f1f5f9;
  --glass-bg: rgba(255,255,255,0.08);
  --glass-border: rgba(255,255,255,0.2);
}
body {
  font-family: 'Tajawal', sans-serif;
  background: var(--bg);
  color: var(--text);
  transition: 0.4s;
  min-height: 100vh;
  user-select: none;
}
.glass {
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  backdrop-filter: blur(20px);
  border-radius: 1.4rem;
  padding: 2rem;
  margin: 2rem auto;
  max-width: 800px;
}
a { color: #3b82f6; }
a:hover { text-decoration: underline; }
.theme-switch {
    width: 50px; height: 28px; background: rgba(255,255,255,0.2);
    border-radius: 40px; cursor: pointer; position: relative;
}
.theme-switch .circle {
    width: 24px; height: 24px; background: #fff; border-radius: 50%;
    position: absolute; top: 2px; left: 2px; transition: 0.3s;
}
.dark .theme-switch .circle { transform: translateX(22px); }
body { font-family: 'Cairo', sans-serif; }
</style>
</head>

<body class="flex flex-col min-h-screen">

<!-- HEADER -->
<header class="glass shadow-lg px-6 py-4 flex justify-between items-center">
    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-sky-400 to-indigo-500 bg-clip-text text-transparent">
        📝 مشروع المدوّنة
    </h1>
    <div class="flex items-center gap-4">
        <a href="/blog" class="font-bold">المدونة</a>
        <div id="theme-switch" class="theme-switch"><div class="circle"></div></div>
    </div>
</header>

<!-- المقال -->
<section class="glass mt-6">
    <h1 class="text-3xl font-extrabold mb-4">{{ $blog->title }}</h1>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
        {{ optional($blog->created_at)->format('Y-m-d') }} • {{ $blog->read_time ?? 1 }} دقيقة
    </p>

    <p class="mb-4 leading-7">{!! nl2br(e($blog->content)) !!}</p>

    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        الفئة:
        @if($blog->category)
            <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded">{{ $blog->category->name }}</span>
        @else
            <span class="text-gray-400">بدون فئة</span>
        @endif
    </p>

    <div class="flex flex-col gap-3 mt-4">
        <a href="/blog" class="bg-indigo-600 text-white py-2 px-4 rounded font-bold text-center">
            العودة إلى المدونة
        </a>
        <a href="{{ route('blog.downloadPdf', ['id'=>$blog->id]) }}" 
           class="bg-gray-600 text-white py-2 px-4 rounded text-center">
           تحميل PDF
        </a>

        @auth
        <livewire:article-summary :blogId="$blog->id" wire:key="summary-{{ $blog->id }}" />
        <livewire:article-bookmark :articleId="$blog->id" wire:key="bookmark-{{ $blog->id }}" />
        <livewire:article-rating :articleId="$blog->id" wire:key="rating-{{ $blog->id }}" />
        @else
        <button onclick="alert('سجّل دخولك أولاً')"
                class="bg-gray-400 text-white py-2 rounded">
            حفظ / تقييم / تلخيص
        </button>
        @endauth
    </div>
</section>

<!-- FOOTER -->
<footer class="glass text-center p-5 mt-auto rounded-t-3xl shadow-xl text-lg opacity-95">
    © 2025 مشروع المدوّنة | جميع الحقوق محفوظة
</footer>

@livewireScripts
<script>
feather.replace();

// Theme switch
const themeSwitch = document.getElementById('theme-switch');
const circle = themeSwitch.querySelector('.circle');
function setTheme(theme){
    document.documentElement.classList.toggle('dark', theme==='dark');
    circle.textContent = theme==='dark' ? '🌙':'🌞';
    document.cookie = "theme="+theme+";path=/;max-age=31536000";
}
let theme = document.cookie.includes('theme=dark') ? 'dark':'light';
setTheme(theme);
themeSwitch.onclick = ()=>setTheme(document.documentElement.classList.contains('dark')?'light':'dark');

// حماية النسخ وPrintScreen
document.addEventListener('contextmenu', e => e.preventDefault());
document.addEventListener('copy', e => e.preventDefault());
document.addEventListener('cut', e => e.preventDefault());
document.addEventListener('keydown', function(e){
    if((e.ctrlKey && ['c','x','s','u','p'].includes(e.key.toLowerCase())) ||
       (e.ctrlKey && e.shiftKey && e.key.toLowerCase()==='i') ||
       e.key==='PrintScreen'){
        e.preventDefault();
        alert('الصفحة محمية ولا يمكن نسخ المحتوى أو أخذ صورة للشاشة.');
    }
});
window.addEventListener('keyup', function(e){
    if(e.key==='PrintScreen'){ navigator.clipboard.writeText(''); alert('تم مسح الصورة من الحافظة.'); }
});
</script>

</body>
</html>
