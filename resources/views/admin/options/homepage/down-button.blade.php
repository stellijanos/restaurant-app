@if($loop->index < count($images)-1)
    <form action="{{route('patch_menu_image', ['id'=>$image->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="prev" value="{{$images[$loop->index+1]->id}}">
        <button type="submit" class="btn btn-warning">DOWN</button>
    </form>
@else 
    <button type="button" class="btn btn-secondary" disabled>DOWN</button>
@endif