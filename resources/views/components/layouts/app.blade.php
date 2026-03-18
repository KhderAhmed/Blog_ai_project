<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة تحكم الأدمن</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
@livewireStyles
<style>
:root { --bg: linear-gradient(135deg,#e0f2fe,#bae6fd); --text:#111827; --glass-bg: rgba(255,255,255,0.6); --glass-border: rgba(0,0,0,0.12); }
.dark { --bg: linear-gradient(135deg,#1e293b,#0f172a); --text:#f9fafb; --glass-bg: rgba(255,255,255,0.08); --glass-border: rgba(255,255,255,0.2); }
body { font-family: 'Tajawal', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; transition: background 0.4s, color 0.4s; }
.glass { background: var(--glass-bg); border:1px solid var(--glass-border); backdrop-filter: blur(22px); border-radius:1.5rem; transition: all 0.4s; }
header.glass { display:flex; justify-content:space-between; align-items:center; gap:1rem; padding:1rem 2rem; margin-bottom:2rem; }
.nav-links a { display:flex; align-items:center; gap:0.5rem; padding:0.5rem 1rem; border-radius:0.75rem; font-weight:bold; transition:all 0.3s; }
.nav-links a:hover { transform:scale(1.05); background:rgba(255,255,255,0.15); }
.theme-switch { width:58px; height:30px; border-radius:30px; cursor:pointer; background:rgba(255,255,255,0.15); position:relative; transition:.3s; }
.theme-switch .circle { width:26px; height:26px; background:white; border-radius:50%; position:absolute; top:2px; left:2px; display:flex; align-items:center; justify-content:center; font-size:16px; transition:.3s; }
.dark .theme-switch .circle { transform:translateX(28px); }
.stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:1rem; margin-bottom:2rem; }
.stats .card { padding:1.5rem; border-radius:1rem; background:rgba(255,255,255,0.2); text-align:center; backdrop-filter:blur(15px); }
.stats .card h3 { font-size:1.5rem; font-weight:bold; margin-bottom:0.5rem; }
.stats .card p { font-size:1rem; }
</style>
</head>
<body class="dark">

<header class="glass rounded-b-2xl shadow-lg">
    <h1 class="text-2xl font-extrabold bg-gradient-to-r from-sky-400 to-indigo-500 bg-clip-text text-transparent flex items-center gap-2">📝 لوحة تحكم الأدمن</h1>

    <nav class="nav-links flex gap-4 items-center text-lg">
        <span class="px-3 py-1 bg-green-500 text-white rounded">{{ auth()->guard('admin')->user()->name }}</span>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">تسجيل خروج</button>
        </form>
    </nav>

    <div id="theme-switch" class="theme-switch">
        <div class="circle">🌞</div>
    </div>
</header>

<main class="p-6 max-w-7xl mx-auto space-y-6">

    <!-- إحصائيات -->
    <livewire:admin-dashboard-stats />

{{ $slot }}

</main>

<footer class="glass text-center p-5 rounded-t-3xl mt-auto shadow-xl text-lg opacity-90">
    © 2025 مشروع المدوّنة | جميع الحقوق محفوظة
</footer>

@livewireScripts
<script>
feather.replace({ 'stroke-width':2 });

const themeSwitch=document.getElementById('theme-switch');
const circle=themeSwitch.querySelector('.circle');

function setTheme(theme){
    if(theme==='dark'){ document.documentElement.classList.add('dark'); circle.textContent='🌙'; }
    else{ document.documentElement.classList.remove('dark'); circle.textContent='🌞'; }
    document.cookie="theme="+theme+";path=/;max-age=31536000";
}

function getCookie(name){
    const value="; "+document.cookie;
    const parts=value.split("; "+name+"=");
    if(parts.length===2) return parts.pop().split(";").shift();
}

let theme=getCookie('theme'); 
if(!theme) theme=window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light'; 
setTheme(theme);

themeSwitch.addEventListener('click',()=>{ 
    setTheme(document.documentElement.classList.contains('dark')?'light':'dark'); 
});
</script>
</body>
</html>