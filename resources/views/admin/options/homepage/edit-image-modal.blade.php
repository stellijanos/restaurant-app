<div class="modal fade" id="edit-homepage-image-{{$image->id}}" tabindex="-1" aria-labelledby="edit-homepage-image-label-{{$image->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" action="{{route('update_homepage_image', ['id' => $image->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-homepage-image-label-{{$image->id}}">Edit homepage image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="image-image mb-3" style="display:flex; justify-content:center; align-items:center">
                    <img src="{{asset('/storage/app/public/images/homepage').'/'.$image->image}}" class="img-fluid" height="400" width="400" alt="{{$image->image}}" style="margin:auto">
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="caption" value="{{$image->caption}}" id="image-name-caption" placeholder="Caption">
                    <label for="image-item-name">Caption</label>
                </div>
               
                <div class="form-floating mb-3" id="change_item_image-{{$image->id}}">
                    <label for="new_image">Change image(.jpg, .jpeg, .png)</label><br><br>
                    <input type="file" name="new_image" id="new_image" class="form-control">
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-{{$image->id}}" name="show" {{ $image->show_on_homepage == 1 ? "checked" : ""}}>
                    <label for="checkbox-{{$image->id}}">Show on homepage</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
