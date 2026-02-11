@props(['title', 'info' => null, 'link', 'disabled' => false, 'disabledInfo' => null])
@if ($disabled)
    <div class="">
    @else
        <a href="{{ route($link) }}">
@endif
<div class="@if ($disabled) opacity-50 @endif bg-[#cccccc57] p-4 rounded-xl flex flex-col text-center gap-4 text-black min-h-40">
    <div class="">
        <h2 class="text-2xl uppercase font-bold">{{ ucfirst($title) }}</h2>
    </div>
    <div class="">
        @if ($disabled && $disabledInfo)
            {{ $disabledInfo }}
        @else
            {{ $info }}
        @endif

    </div>
    @if (!$disabled)
        <div class="">
            <p class="text-slate-600 italic">{{ $slot->isEmpty() ? __('admin.card_action') : $slot }}</p>
        </div>
    @endif
</div>
@if ($disabled)
    </div>
@else
    </a>
@endif
