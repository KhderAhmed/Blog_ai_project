<div class="w-full mt-2">

    @php
        $article = \App\Models\Article::find($blogId);
    @endphp

    @if($article && trim(strip_tags($article->content)))
        <!-- زر التلخيص -->
        <button
            wire:click="generateSummary"
            wire:loading.attr="disabled"
            class="px-5 py-2 rounded-xl
                   bg-gradient-to-r from-sky-500 to-indigo-500
                   text-white font-bold shadow-lg
                   hover:scale-105 hover:shadow-xl transition-transform duration-300
                   disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">

            ✨ تلخيص المقال
            <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        </button>
    @else
        <span class="text-gray-500 italic">المحتوى غير متوفر للتلخيص</span>
    @endif

    <!-- الملخص -->
    @if(!empty($summary))
        <div class="mt-4 p-4 rounded-2xl shadow-lg
                    max-h-60 overflow-y-auto
                    text-sm leading-6 transition-all
                    bg-white/60 dark:bg-gray-800/60 backdrop-blur-md">

            <h4 class="font-bold mb-2 flex items-center gap-2 text-indigo-600">📌 الملخص</h4>
            <p>{{ $summary }}</p>

            <!-- زر نسخ الملخص -->
            <button onclick="navigator.clipboard.writeText('{{ $summary }}')"
                    class="mt-2 px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">
                📋 نسخ الملخص
            </button>
        </div>
    @endif

</div>