<div class="modal fade" id="create-menu-item" tabindex="-1" aria-labelledby="create-menu-item-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('create_menu_item')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-menu-item-label">Add new menu item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="menu-item-name" placeholder="Name">
                        <label for="menu-item-name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="price" id="menu-item-price" placeholder="Price" step=".01" min="0">
                        <label for="floatingInput">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="weight" placeholder="Weight (in g)" step=".01" min="0">
                        <label for="floatingInput">Weight (in g)</label>
                    </div>
                    <select name="category" class="form-select form-select-lg mb-3">
                        <option value="0" selected>Choose category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mb-3">
                        <label for="item_image">Upload 1 image(.jpg, .jpeg, .png)</label><br><br>
                        <input type="file" name="item_image" id="item_image" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create item</button>
                </div>
            </form>
        </div>
    </div>
</div>

