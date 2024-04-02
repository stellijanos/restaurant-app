<div class="modal fade" id="create-homepage-image" tabindex="-1" aria-labelledby="create-homepage-image-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{route('create_homepage_image')}}" method="POST">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create-homepage-image-label">Add new homepage item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body form-inputs">
                <div class="form-floating mb-3">
                    <input type="text" name="image_name" id="image-name" class="form-control" placeholder="Enter image name">
                    <label for="image-name">Enter image name</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create image</button>
            </div>
        </form>
    </div>
</div>
