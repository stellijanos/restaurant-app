<form action="{{route('delete_category', ['id' => $food->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>