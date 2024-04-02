<div class="menu-image-name-block">
    <input type="text" name="name"  id="image_{{$image->id}}" value="{{$image->name}}" disabled oninput="changeToSubmitBtn(this)">
    <button type="button" style="width:100px;" class="btn btn-secondary" id="btn_image_{{$image->id}}">Edit</button>
</div>
