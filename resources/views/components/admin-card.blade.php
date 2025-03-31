@props(['title', 'info' => null, 'link'])
<a href="{{ route($link) }}">
    <div class="bg-[#cccccc57] p-4 rounded-xl flex flex-col text-center gap-4 text-black">
        <div class="">
            <h2 class="text-2xl uppercase font-bold">{{ ucfirst($title) }}</h2>
        </div>
        <div class="">
            {{ $info }}
        </div>
        <div class="">
            <p class="text-slate-600 italic">{{ $slot }}</p>
        </div>
    </div>
</a>