<div class="modal fade" id="edit-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="edit-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('update_menu_item', ['id' => $food->id])}}" method="post">
                @csrf
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
                        <input type="number" class="form-control" name="price" value="{{$food->price}}" id="menu-item-price" placeholder="Price" pattern="\d*\.?\d*" min="0">
                        <label for="floatingInput">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="weight" value="{{$food->weight}}" placeholder="Weight (in g)" pattern="\d*\.?\d*" min="0">
                        <label for="floatingInput">Weight (in g)</label>
                    </div>
                    <select name="category" class="form-select form-select-lg">
                        <option value="0" >Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $food->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
