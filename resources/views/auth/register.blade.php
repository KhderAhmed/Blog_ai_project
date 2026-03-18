<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Register' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(-45deg, #3b82f6, #6366f1, #0ea5e9, #9333ea);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border-radius: 1.5rem;
            padding: 3rem;
            max-width: 450px;
            width: 95%;
            color: white;
        }

        input {
            width: 100%;
            padding: 1rem;
            border-radius: 0.75rem;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1rem;
        }

        input::placeholder {
            color: #ddd;
        }

        input:focus {
            outline: none;
            border-color: #fff;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        button {
            width: 100%;
            padding: 1rem;
            border-radius: 0.75rem;
            background: #fff;
            color: #111;
            font-weight: bold;
            font-size: 1rem;
            transition: 0.3s;
            margin-top: 0.5rem;
        }

        button:hover {
            transform: scale(1.05);
        }

        a {
            color: #f3f4f6;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <section class="glass animate-fadeIn">

        <div class="text-center space-y-2 mb-6">
            <h2 class="text-4xl font-bold">📝 تسجيل مستخدم جديد</h2>
            <p class="text-gray-300 text-base">املأ البيانات للانضمام للموقع</p>
        </div>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-xl text-sm mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('do.register') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="text-base font-semibold">اسم المستخدم</label>
                <input type="text" name="name" placeholder="أدخل اسم المستخدم">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-base font-semibold">الايميل</label>
                <input type="email" name="email" placeholder="أدخل الايميل">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2 relative">
                <label class="text-base font-semibold">كلمة المرور</label>
                <input id="password" type="password" name="password" placeholder="أدخل كلمة المرور">
                <span onclick="togglePassword()"
                    class="absolute left-4 top-[48px] cursor-pointer text-gray-300 text-lg">👁️</span>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-base font-semibold">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" placeholder="أعد كتابة كلمة المرور">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">🚀 تسجيل</button>
        </form>

        <div class="text-center text-sm mt-4">
            هل لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a><br>
            <a href="/privacy" class="hover:underline mt-2 block">سياسة الخصوصية</a>
        </div>

    </section>

    <script>
        function togglePassword() {
            let x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
