<div id="personal-info">
    <h3 style="text-align:center">Fill out your information</h3>
    <p style="text-align:center">(all fields marked with * are mandatory)</p>
    @if($errors->any())
        <div style="background-color:#ff7f7f; border-radius:10px; padding:10px; margin-bottom:10px;">
            @foreach($errors->all() as $error) 
                <li>{{$error}}</li>
            @endforeach
        </div>
    @endif
    <form action="{{route('place-order')}}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" >
            <label for="firstname">Firstname *</label>
        </div>                
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
            <label for="lastname">Lastname *</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
            <label for="phone">Phone *</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            <label for="email">Email *</label>
        </div>
        @if(trim($_COOKIE['delivery_type'] ?? '','"') !== 'pickup')
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="street" id="street" placeholder="Street">
                <label for="street">Street *</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="number" id="number" placeholder="Nr.">
                <label for="number">Nr. *</label>
            </div>
        @else 
            <div class="btn btn-warning mb-3" style="width:100%;">
                <b>This is a pickup order, so you need to go to the restaurant.</b>
            </div>
        @endif
        <div class="mb-3">
            <input type="hidden" name="delivery-type" value="{{trim($_COOKIE['delivery_type'] ?? '','"')}}">
            <button class="btn btn-success" type="submit" style="width:100%;">Send order</button>
        </div>
    </form>
</div>

