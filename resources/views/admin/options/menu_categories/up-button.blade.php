@if($loop->index >= 1)
    <form action="{{route('patch_menu_category',['id'=>$category->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="prev" value="{{$categories[$loop->index-1]->id}}">
        <button type="submit" class="btn btn-warning">UP</button>
    </form>
@else 
    <button type="button" class="btn btn-secondary" disabled>UP</button>
@endif 