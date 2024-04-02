<div class="modal fade" id="create-homepage-image" tabindex="-1" aria-labelledby="create-homepage-image-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{route('create_homepage_image')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create-homepage-image-label">Add new homepage item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body form-inputs">
                <div class="mb-3">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="image-caption" id="image-caption" class="form-control" placeholder="Enter image name">
                    <label for="image-name">Enter image caption</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
