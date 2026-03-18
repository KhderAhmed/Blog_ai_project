<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'مشروع المدوّنة' }}</title>

<script src="https://cdn.tailwindcss.com"></script>
@livewireStyles

<style>
body {
    font-family: 'Tajawal', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

    /* 🎬 Gradient متحرك */
    background: linear-gradient(-45deg, #3b82f6, #6366f1, #0ea5e9, #9333ea);
    background-size: 400% 400%;
    animation: gradientMove 12s ease infinite;
}

/* حركة الخلفية */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
</style>

</head>

<body>

<!-- الفورم -->
<section class="w-full max-w-lg p-10 rounded-2xl shadow-2xl
                bg-white/10 backdrop-blur-2xl text-white space-y-6">

    <!-- عنوان -->
    <div class="text-center space-y-2">
        <h2 class="text-3xl font-extrabold">🔐 سياسة الخصوصية</h2>
        <p class="text-sm opacity-80">نلتزم بحماية بياناتك</p>
    </div>

    <!-- المحتوى -->
    <div class="space-y-4 text-sm leading-7">

        <div class="bg-white/10 p-4 rounded-xl">
            📁 يتم حفظ البيانات مؤقتًا فقط أثناء المعالجة.
        </div>

        <div class="bg-white/10 p-4 rounded-xl">
            🔑 كلمات المرور مشفرة بالكامل.
        </div>

        <div class="bg-white/10 p-4 rounded-xl">
            ✅ باستخدامك الموقع، أنت توافق على السياسة.
        </div>

    </div>

    <!-- زر -->
    <a href="/login"
       class="block w-full text-center py-3 rounded-xl
              bg-white text-black font-bold
              hover:scale-105 transition">
        ⬅️ رجوع لتسجيل الدخول
    </a>

</section>

</body>
</html>