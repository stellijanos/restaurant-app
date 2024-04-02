<form action="{{route('delete_homepage_image', ['id' => $image->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
