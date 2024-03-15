<div class="modal fade" id="edit-profile" tabindex="-1" aria-labelledby="edit-profile-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('update_admin_profile')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit-profile-label">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="{{auth()->user()->name}}" placeholder="Name" autocomplete>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" value="{{auth()->user()->email}}" placeholder="email">
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current password">
                        <label for="current_password">Current password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password">
                        <label for="new_password">New password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password">
                        <label for="confirm_password">Confirm new password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="remove_picture" id="remove_picture" onclick="hide('change_picture_div')">
                        <label for="remove_picture">Remove profile picture</label>
                    </div>
                    <div class="form-floating mb-3" id="change_picture_div">
                        <label for="new_image">Change profile picture(.jpg, .jpeg, .png)</label><br><br>
                        <input type="file" name="new_image" id="new_image" class="form-control">
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

<script>
    const hide = id => {
        let div = document.getElementById(id);

        if (div.style.display ==="none") {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>