@foreach($images as $image) 
    <div class="menu-image-block">
        {{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.
        <form class="menu-image-form-block" action="{{route('update_menu_image', ['id' => $image->id])}}" method="POST" id="form-image-{{$image->id}}">
            @csrf
            @method('PUT')
            @include($source.'edit_image_name')
        </form>
        <div class="menu-image-position-block">
            <p style="margin-top:10px">Move on menu list: </p>
            @include($source.'up-button')
            @include($source.'down-button')
        </div>
        @include($source.'delete-button')
    </div>
    <hr>
@endforeach
