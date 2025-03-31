@extends('layouts.email')

@section('title')
Radio Ostrov
@endsection

@section('username')
{{ $user->name }}
@endsection

@section('bodyTitle')
Kliknutím nižšie overíte svoj účet.
@endsection

@section('action')
<tr>
  <td align="center" style="padding: 20px 0;">
    <table cellspacing="0" cellpadding="0" border="0" align="center" width="80%">
      <tr>
        <td align="center" bgcolor="#cfe2f3" style="border-radius: .25rem;">
          <a href="{{ $url }}" target="_blank"
            style="padding: .5rem 0px; display: inline-block; text-transform: uppercase; font-weight: bold; text-align: center; text-decoration: none; color: #000000; width: 100%; cursor: pointer;">
            Overiť účet
          </a>
        </td>
      </tr>
    </table>
  </td>
</tr>
@endsection

@section('body')
<tr>
  <td align="left" style="padding: 3.5rem; font-size: .875rem; line-height: 1.5;">
    <p style="font-weight: bold;">Ak ste túto obnovu hesla nežiadal, prosím ignorujte tento email.</p>
    <p>Ak potrebujete s niečím pomôcť píšte na mail <a class="text-blue-600 hover:underline"
        href="mailto:radio@ostrovskeho.com">radio@ostrovskeho.com</a></p>
  </td>
</tr>
<p style="">Tím Rádia Ostrov.</p>
@endsection