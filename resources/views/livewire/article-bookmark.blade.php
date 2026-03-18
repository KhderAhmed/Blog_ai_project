<div>
  <!-- resources/views/livewire/article-bookmark.blade.php -->
<button wire:click="toggle"
    class="px-4 py-2 rounded-xl font-bold transition
    {{ $bookmarked ? 'bg-yellow-500 text-white' : 'bg-gray-300 text-black' }}">
    {{ $bookmarked ? '★ محفوظ' : '☆ حفظ للمطالعة لاحقاً' }}
</button>

</div>
