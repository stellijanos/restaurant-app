

<h1>Welcome back, <strong>{{ auth()->user()->name }}</strong>!</h1> 

@if($errors->any()) 
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
