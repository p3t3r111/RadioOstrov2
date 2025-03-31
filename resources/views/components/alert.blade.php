@props(['type'])
@php
  if ($type == 'success') {
    $bg = 'bg-green-400';
    $logo = '
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
      </svg>';
  } elseif ($type == 'info'){
    $bg = 'bg-blue-400';
    $logo = '
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
</svg>
';
  } else {
    $bg = 'bg-red-400';
    $logo = '
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>';
  }
@endphp
<section class="alert flex justify-end opacity-0 transition-opacity duration-500">
  <div class="flex items-center rounded-xl min-w-56 my-6 mx-2 shadow-xl border-r-[1px] border-t-[1px] border-black absolute">
    <div class="{{ $bg }} p-2 rounded-s-xl">
      {!! $logo !!}
    </div>
    <div class="whitespace-nowrap overflow-hidden text-sm px-2">
      <p>{{ $slot }}</p>
    </div>
  </div>
</section>