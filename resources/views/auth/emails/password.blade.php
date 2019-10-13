{{-- resources/views/emails/password.blade.php --}}
Hi,<br><br>

You recently made a request to reset your IMPRESSO login password. To complete the process, click the link below. If you didn't make this request, please ignore this email.<br><br>

<a href="{{ url('password/reset/'.$token) }}">CHANGE PASSWORD</a><br><br>

Best Regards,<br>
<strong>Impresso Team</strong><br><br>

www.impressoapp.com  - “ Face to Face professional networking for business and career growth. “<br><br>

<p style="display: inline-block;">
    <a href="https://apps.apple.com/my/app/impresso/id1479981704"><img width="110" height="44" src="{{asset('/img/download_ios.png')}}"/></a>&nbsp;&nbsp;
    <a href="https://play.google.com/store/apps/details?id=impresso.lite.valididentity"><img width="110" height="44" src="{{asset('/img/download_and.png')}}"/></a>
</p>



