<form action="{{route('delete_menu_category', ['id' => $category->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>