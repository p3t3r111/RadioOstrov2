@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/logo.png') }}" class="logo" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
@endif
</a>
</td>
</tr>