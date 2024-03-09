<div class="modal fade" id="create-menu-category" tabindex="-1" aria-labelledby="create-menu-category-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('create_menu_category')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-menu-category-label">Add new menu item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body form-inputs">
                    <div class="form-floating mb-3">
                        <input type="text" name="category_name" id="category-name" class="form-control" placeholder="Enter category name">
                        <label for="category-name">Enter category name</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create category</button>
                </div>
            </form>
        </div>
    </div>
</div>
