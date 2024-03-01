
@extends('layouts.header_footer')

@section('content')

<style>

    body {
        background-color: #3c6e71;
    }

    #login-form {
        display:flex;
        flex-direction:row;
        justify-content:center;
        align-items:center;
        width:100%;
        height:calc(100vh - 50px);
    }

    #login-form form {
        min-width:300px;
        max-width:500px;
        text-align:center;
    }

    #login-btn {
        width:150px;
    }

    #error-message {
        background-color:red;
        color:#fff;
        border-radius:5px;
    }

</style>

<div id="login-form">

      

    <form action="{{route('login_form')}}" method="POST">
        
        <div class="mb-3">
            <h1 style="color:darkgrey">Login portal</h1>
        </div>

        @if(session()->has('error_message')) 
            <div id="error-message"><p >{{session('error_message')}}</p></div>
        @endif

        @csrf

        <div class="form-floating mb-3">
        
            <input type="text" class="form-control" id="floatingInput" name="username"  placeholder="Username" value="{{session()->has('username') ? session('username') : '' }}" required>
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-lg" id="login-btn">Login</button>

    </form>

</div>
    
</body>
</html>

@endsection
