<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Login Form here</h1>

    <form action="{{route('login_form')}}" method="POST">
        @csrf
        <input type="text" name="username" id="username" placeholder ="Username">
        <input type="password" name="password" id="password" placeholder="password">
        <button type="submit">Login</button>
    </form>


    @if(session()->has('error_message')) 
        <div>{{session('error_message')}}</div>
    @endif
    
</body>
</html>
