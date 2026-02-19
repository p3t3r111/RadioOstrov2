@props(['disabled' => false, 'value' => null, 'name' => null])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full rounded-md border-gray-300 bg-gray-100 disabled:cursor-not-allowed shadow-sm dark:bg-darkMode-background-900 dark:border-slate-700 dark:text-slate-400']) !!} value="{{ $value }}" name="{{ $name }}">
