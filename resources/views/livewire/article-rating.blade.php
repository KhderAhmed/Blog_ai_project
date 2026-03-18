<div class="flex gap-1">
    @for ($i = 1; $i <= 5; $i++)
        <span
            wire:click="rate({{ $i }})"
            class="text-2xl cursor-pointer"
            style="color: {{ $i <= $rating ? 'gold' : '#ccc' }};"
            title="{{ $i }} نجوم">
            ★
        </span>
    @endfor
</div>
