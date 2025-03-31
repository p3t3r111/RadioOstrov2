@props(['name', 'type' => 'text', 'autocomplete' => 'off','iconPath','mt_2'=>'false','value'=>null,'readonly'=>null])

<div class="@if ($mt_2) mt-2 @endif w-full">
  <div class="md-textbox relative border-b-2 border-[#305582] w-full">
    <input 
      oninput="handleInputChange('{{ $name }}')" 
      @if ($type != 'password')
        value="{{ $value ?? old($name) }}"
      @endif
      id="{{ $name }}" 
      type="{{ $type }}" 
      name="{{ $name }}" 
      autocomplete="{{ $autocomplete }}"
      @if ($readonly===true)
        readonly
      @endif
      class="h-14 w-full pl-4 border-none focus:ring-0 pr-10"
    />
    <span class="inputSpan absolute flex items-center gap-2 right-4 top-[30%] text-[#888888] pointer-events-none">
      @if ($type == 'email')
      <p class="text-sm lg:text-base">@ostrovskeho.com</p>
      @endif
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
      stroke="currentColor" class="w-6 h-6 text-[#888888]">
        {!! $iconPath !!}
      </svg>
    </span>
    <label for="{{ $name }}" class="absolute top-[30%] text-[#888888] left-4">{{ $slot }}</label>
  </div>
  <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
