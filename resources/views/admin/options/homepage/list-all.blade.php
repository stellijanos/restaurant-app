@foreach($images as $image) 
    <div class="homepage-image-block">

        <p>{{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.</p>
        <img src="{{asset('/storage/app/public/images/homepage').'/'.$image->image}}" class="img-fluid" height="200" width="200" alt="{{$image->name}}">
        <div style="width:250px;">
            <p>{{$image->caption}}</p>
        </div>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-homepage-image-{{$image->id}}">
            Edit 
        </button>

        @include($source.'edit-image-modal')

    
        <div class="homepage-image-position-block">
            <p style="margin-top:10px">Move on homepage list: </p>
            @include($source.'up-button')
            @include($source.'down-button')
        </div>
        @include($source.'delete-button')
    </div>
    <hr>
@endforeach
