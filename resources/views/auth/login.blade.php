<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(-45deg, #3b82f6, #6366f1, #0ea5e9, #9333ea);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0%
            }

            50% {
                background-position: 100%
            }

            100% {
                background-position: 0%
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border-radius: 1.5rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.7rem;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        input::placeholder {
            color: #ddd;
        }

        input:focus {
            outline: none;
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .btn {
            background: white;
            color: #111;
            font-weight: bold;
            padding: 0.8rem;
            border-radius: 0.7rem;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <!-- Left Side -->
    <div class="hidden md:flex w-1/2 items-center justify-center text-white p-10">
        <div>
            <h1 class="text-5xl font-bold mb-4">🚀 مشروع المدوّنة</h1>
            <p class="text-lg opacity-80">
                منصة حديثة لإدارة المقالات بطريقة ذكية وسهلة.
            </p>
        </div>
    </div>

    <!-- Right Side -->
    <section class="glass w-full max-w-lg p-10 space-y-6 mx-auto">

        <div class="text-center space-y-2">
            <h2 class="text-4xl font-bold">👋 أهلاً بك</h2>
            <p class="text-gray-500 dark:text-gray-300 text-base">
                سجل الدخول للمتابعة
            </p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-xl text-sm">
                ❌ {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('do.login') }}" class="space-y-5">
            @csrf

            <!-- اسم المستخدم -->
            <div class="space-y-2">
                <label class="text-base font-semibold">اسم المستخدم</label>
                <input type="text" name="name" placeholder="أدخل اسم المستخدم"
                    class="w-full p-4 text-lg rounded-xl border focus:ring-2 focus:ring-blue-400">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- كلمة المرور -->
            <div class="space-y-2 relative">
                <label class="text-base font-semibold">كلمة المرور</label>

                <input id="password" type="password" name="password" placeholder="أدخل كلمة المرور"
                    class="w-full p-4 text-lg rounded-xl border focus:ring-2 focus:ring-blue-400">

                <!-- زر إظهار -->
                <span onclick="togglePassword()"
                    class="absolute left-4 top-[48px] cursor-pointer text-gray-500 text-lg">
                    👁️
                </span>

                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- زر -->
            <button type="submit"
                class="w-full py-4 text-lg rounded-xl
                       bg-blue-600 text-white font-bold
                       hover:bg-blue-700 hover:scale-[1.02]
                       transition">
                🚀 تسجيل الدخول
            </button>
        </form>

        <!-- روابط -->
        <div class="text-center text-sm mt-4">
             <p class="text-center mt-4 text-sm">هل لديك حساب؟ <a href="{{ route('register') }}">تسجيل حساب جديد</a></p>
            <a href="/privacy" class="text-blue-500 hover:underline">
                سياسة الخصوصية
            </a>
        </div>

    </section>

    <script>
        function togglePass() {
            let x = document.getElementById("pass");
            x.type = x.type === "password" ? "text" : "password";
        }

        function loading() {
            let btn = document.getElementById("btn");
            btn.innerHTML = "⏳ جاري الدخول...";
            btn.disabled = true;
        }
    </script>

</body>

</html>
