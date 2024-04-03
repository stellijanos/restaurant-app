
@foreach($images as $image) 
    <div class="homepage-image-block">

        <p style="width:20px">{{($loop->index+1 < 10 ? '0' : '').$loop->index+1}}.</p>
        <div style="width:200px">
            <img src="{{asset('/storage/app/public/images/homepage').'/'.$image->image}}" class="img-fluid" alt="{{$image->name}}">
        </div>
        <div style="width:100px; margin-left:20px; text-align:center">
            <p>Caption:</p>
            <p>{{$image->caption}}</p>
        </div>
        <div style="width:150px; text-align:center;">
            <p>Show on homepage:</p>
            <p>{{$image->show_on_homepage ? 'YES' : 'NO'}}</p>
        </div>
        <div class="homepage-image-position-block">
            <p style="margin-top:10px">Order it: </p>
            @include($source.'up-button')
            @include($source.'down-button')
        </div>
        <div class="edit-button">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-homepage-image-{{$image->id}}">
                Edit 
            </button>
        </div>
        @include($source.'delete-button')
        @include($source.'edit-image-modal')
    </div>
    <hr>
@endforeach
