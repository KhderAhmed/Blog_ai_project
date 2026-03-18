<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'مشروع المدوّنة' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    @livewireStyles
    <style>
        /* Base light theme */
        :root {
            --bg: linear-gradient(135deg, #e0f2fe, #bae6fd);
            --text: #111827;
            --glass-bg: rgba(255, 255, 255, 0.6);
            --glass-border: rgba(0, 0, 0, 0.12);
        }

        /* Dark theme */
        .dark {
            --bg: linear-gradient(135deg, #1e293b, #0f172a);
            --text: #f9fafb;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        /* Apply colors */
        body {
            font-family: 'Tajawal', sans-serif;
            transition: background 0.4s, color 0.4s;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* Glass effect */
        .glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(22px);
            border-radius: 1.5rem;
            transition: all 0.4s;
        }

        /* Header */
        header.glass {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            gap: 1rem;
        }

        /* Nav links */
        .nav-links a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: bold;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .nav-links a:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.15);
        }

        /* Theme Switch */
        .theme-switch {
            width: 58px;
            height: 30px;
            border-radius: 30px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.15);
            position: relative;
            transition: .3s;
        }

        .theme-switch .circle {
            width: 26px;
            height: 26px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: .3s;
        }

        .dark .theme-switch .circle {
            transform: translateX(28px);
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease forwards;
        }

        .animate-fadeIn.delay-100 {
            animation-delay: 0.1s;
        }

        .animate-fadeIn.delay-200 {
            animation-delay: 0.2s;
        }

        .animate-fadeIn.delay-300 {
            animation-delay: 0.3s;
        }

        .animate-fadeIn.delay-400 {
            animation-delay: 0.4s;
        }

        .animate-fadeIn.delay-500 {
            animation-delay: 0.5s;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <!-- Header -->
    <header class="glass rounded-b-2xl shadow-lg">
        <h1
            class="text-2xl sm:text-3xl font-extrabold bg-gradient-to-r from-sky-400 to-indigo-500 bg-clip-text text-transparent flex items-center gap-2">
            📝 مشروع المدوّنة
        </h1>



        <nav class="nav-links flex gap-4 items-center text-lg">
            <a href="/login"><i data-feather="grid"></i> Login</a>
            <a href="/blog"><i data-feather="book-open"></i> Blog</a>
            <a href="/"><i data-feather="shield"></i>Welcome</a>
        </nav>

        <div id="theme-switch" class="theme-switch">
            <div class="circle">🌞</div>
        </div>
        </div>
    </header>


    <!-- Main Content -->
    <main class="flex-1 w-full flex flex-col items-center p-6 space-y-10">

        <section
            class="glass p-10 max-w-4xl text-center space-y-6 shadow-xl transform transition duration-500 hover:scale-105 hover:shadow-2xl">
            <h2 class="text-4xl font-extrabold">مرحباً بك في مشروع المدوّنة</h2>
            <p class="text-lg">يمكنك إدارة المقالات، توليد الملخصات، اقتراح العناوين وTags، وإعادة صياغة النصوص يدويًا.
            </p>
            {{-- <a href="/dashboard" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">الذهاب للوحة التحكم</a> --}}
        </section>

    </main>
    </div>
    <!-- Footer -->
    <footer class="glass text-center p-5 rounded-t-3xl mt-auto shadow-xl text-lg opacity-90">
        <p>© 2025 مشروع المدوّنة | جميع الحقوق محفوظة</p>
    </footer>
    @livewireScripts
    <script>
        feather.replace({
            'stroke-width': 2
        });

        // Theme toggle
        const themeSwitch = document.getElementById('theme-switch');
        const circle = themeSwitch.querySelector('.circle');

        function setTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                circle.textContent = '🌙';
            } else {
                document.documentElement.classList.remove('dark');
                circle.textContent = '🌞';
            }
            document.cookie = "theme=" + theme + ";path=/;max-age=31536000";
        }

        function getCookie(name) {
            const value = "; " + document.cookie;
            const parts = value.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift();
        }

        let theme = getCookie('theme');
        if (!theme) theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        setTheme(theme);

        themeSwitch.addEventListener('click', () => {
            setTheme(document.documentElement.classList.contains('dark') ? 'light' : 'dark');
        });
    </script>

</body>

</html>
