<div class="p-6 max-w-5xl mx-auto space-y-6">

    <!-- رسالة التنبيه -->
    @if (session()->has('message'))
        <div
            class="p-3 bg-green-500 text-white rounded shadow transition transform duration-300 flex items-center gap-2">
            <span>✅</span>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- فورم إضافة / تعديل المقال -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow space-y-4">
        <h2 class="text-2xl font-bold">{{ $isEditMode ? 'تعديل المقال' : 'إضافة مقال جديد' }}</h2>

        <input type="text" wire:model="title" placeholder="✏️ عنوان المقال"
            class="w-full p-3 border rounded focus:ring-2 focus:ring-sky-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

        <textarea wire:model="content" rows="6" placeholder="📝 محتوى المقال"
            class="w-full p-3 border rounded focus:ring-2 focus:ring-sky-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>

        <!-- اختيار الفئة -->
        <select wire:model="category_id"
            class="w-full p-2 border rounded focus:ring-2 focus:ring-sky-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">اختر فئة</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="flex gap-2 flex-wrap">
            @if ($isEditMode)
                <button wire:click="updateArticle"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">تحديث</button>
                <button wire:click="resetInput"
                    class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">إلغاء</button>
            @else
                <button wire:click="createArticle"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">إضافة</button>
            @endif
        </div>
    </div>

    <!-- فورم إضافة الفئة -->
    <livewire:category-form />

    <!-- تصفية المقالات حسب الفئة -->
    <div class="flex gap-2 mb-4 overflow-x-auto">
        <button wire:click="$set('selectedCategory', null)"
            class="px-3 py-1 bg-sky-500 text-white rounded hover:bg-sky-600 transition">كل الفئات</button>
        @foreach ($categories as $category)
            <button wire:click="$set('selectedCategory', {{ $category->id }})"
                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <!-- جدول المقالات -->
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse text-center mt-6">
            <thead>
                <tr class="bg-sky-400 text-white">
                    <th class="p-3">العنوان</th>
                    <th class="p-3">تاريخ النشر</th>
                    <th class="p-3">الفئة</th>
                    <th class="p-3">أفعال</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr wire:key="article-{{ $article->id }}"
                        class="bg-white dark:bg-gray-700 even:bg-gray-100 dark:even:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 transition">
                        <td class="p-2">{{ $article->title }}</td>
                        <td class="p-2">{{ $article->created_at?->format('Y-m-d') }}</td>

                        <!-- تغيير الفئة مباشرة -->
                        <td class="p-2">
                            <select wire:change="updateArticleCategory({{ $article->id }}, $event.target.value)"
                                class="w-full p-1 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">بدون فئة</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <!-- أزرار المقال -->
                        <td class="p-2 flex flex-col gap-2">
                            <div class="flex gap-2 flex-wrap justify-center">
                                <a href="{{ route('blog.show', $article->id) }}"
                                    class="px-2 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition flex items-center gap-1">
                                    🔍 عرض
                                </a>
                                <button wire:click="editArticle({{ $article->id }})"
                                    class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                    ✏️ تعديل
                                </button>

                                <button wire:click="deleteArticle({{ $article->id }})"
                                    class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                    onclick="confirm('هل أنت متأكد؟') || event.stopImmediatePropagation()">
                                    🗑️ حذف
                                </button>
                            </div>

                            <livewire:article-summary :blog-id="$article->id" :key="$article->id" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
