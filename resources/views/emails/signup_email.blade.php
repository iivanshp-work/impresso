You registered in the <a href="{{ url('/') }}"> Impresso </a> system. <br> <br>

Your login-data: <br> <br>

Email: {{$user->email}} <br>
Password: {{$password}} <br> <br>

You can enter: <a href="{{ url('/sign-in') }}"> {{str_replace ("http: //", "", url ('/ sign-in'))}} </a> . <br> <br>
