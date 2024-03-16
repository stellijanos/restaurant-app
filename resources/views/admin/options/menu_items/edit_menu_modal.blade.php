<div class="modal fade" id="edit-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="edit-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('update_menu_item', ['id' => $food->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit-menu-item-label">Edit menu item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" value="{{$food->name}}" id="menu-item-name" placeholder="Name">
                        <label for="menu-item-name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="price" value="{{$food->price}}" id="menu-item-price" placeholder="Price" step=".01" min="0">
                        <label for="floatingInput">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="weight" value="{{$food->weight}}" placeholder="Weight (in g)" step=".01" min="0">
                        <label for="floatingInput">Weight (in g)</label>
                    </div>
                    <select name="category" class="form-select form-select-lg mb-3">
                        <option value="0" >Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $food->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>

                    @if ($food->image !=='blank_image.png')
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" name="remove_image" id="remove_menu_picture-{{$food->id}}" onclick="hide('change_item_image-{{$food->id}}')">
                            <label for="remove_menu_picture-{{$food->id}}">Remove picture</label>
                        </div>
                    @endif
                    <div class="form-floating mb-3" id="change_item_image-{{$food->id}}">
                        <label for="new_image">Change image(.jpg, .jpeg, .png)</label><br><br>
                        <input type="file" name="new_image" id="new_image" class="form-control">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-{{$food->id}}" name="show" {{ $food->show_on_menu == 1 ? "checked" : ""}}>
                        <label for="checkbox-{{$food->id}}">Show in menu</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
