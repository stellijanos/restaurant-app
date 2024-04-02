@if($loop->index >= 1)
    <form action="{{route('patch_homepage_image',['id'=>$image->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="prev" value="{{$images[$loop->index-1]->id}}">
        <button type="submit" class="btn btn-warning">UP</button>
    </form>
@else 
    <button type="button" class="btn btn-secondary" disabled>UP</button>
@endif 
