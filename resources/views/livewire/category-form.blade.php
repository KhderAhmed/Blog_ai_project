<div class="bg-white/80 dark:bg-gray-800 p-6 rounded-2xl shadow-lg w-full max-w-md mx-auto backdrop-blur-md">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">إضافة فئة جديدة</h1>

    @if($successMessage)
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-3 rounded mb-4 flex items-center gap-2">
            ✅ {{ $successMessage }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="flex flex-col gap-4">
        <label class="flex flex-col text-gray-700 dark:text-gray-200">
            اسم الفئة:
            <input type="text" wire:model.defer="name"
                   class="border p-2 rounded mt-1 focus:ring-2 focus:ring-sky-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                   placeholder="أدخل اسم الفئة">
            @error('name') 
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span> 
            @enderror
        </label>

        <button type="submit"
                class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 hover:scale-105 transition-transform shadow-md flex justify-center items-center gap-2">
            ➕ إضافة الفئة
        </button>
    </form>

    <hr class="my-4 border-gray-300 dark:border-gray-600">

    <h2 class="text-xl font-bold mb-2 text-gray-800 dark:text-white">الفئات الحالية:</h2>
    <ul class="flex flex-col gap-2">
        @foreach($categories as $cat)
            <li class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-2 rounded shadow-sm">
                {{ $cat->name }}
            </li>
        @endforeach
    </ul>
</div>