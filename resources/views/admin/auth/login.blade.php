<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الأدمن</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Light theme */
        :root {
            --bg: linear-gradient(135deg, #e0f2fe, #bae6fd);
            --glass-bg: rgba(255, 255, 255, 0.6);
            --glass-border: rgba(0, 0, 0, 0.12);
            --text-color: #111827;
        }

        /* Dark theme */
        .dark {
            --bg: linear-gradient(135deg, #1e293b, #0f172a);
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.2);
            --text-color: #f9fafb;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: var(--bg);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.4s, color 0.4s;
        }

        .glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(22px);
            border-radius: 1.5rem;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(0,0,0,0.2);
            background-color: rgba(255,255,255,0.7);
            color: var(--text-color);
            margin-top: 5px;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59,130,246,0.3);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            border-radius: 0.75rem;
            font-weight: bold;
            color: white;
            background: #3b82f6;
            margin-top: 15px;
        }

        button:hover {
            background: #2563eb;
        }

        .dark input {
            background-color: rgba(255,255,255,0.1);
            color: #f9fafb;
            border-color: rgba(255,255,255,0.2);
        }

        .dark button {
            background: #2563eb;
        }

        .dark button:hover {
            background: #1e40af;
        }

    </style>
</head>

<body class="dark">

    <section class="glass">
        <h2 class="text-2xl font-bold text-center mb-6">🔐 دخول الأدمن</h2>

        <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
            @csrf

            @if ($errors->any())
                <div class="bg-red-500 p-2 rounded mb-3 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">تسجيل الدخول</button>
        </form>
    </section>

</body>
</html>