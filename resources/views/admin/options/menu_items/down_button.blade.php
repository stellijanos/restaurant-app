@if($loop->index < count($foods)-1)
    <form action="{{route('update_food_patch', ['id'=>$food->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <input type="hidden" name="prev" value="{{$foods[$loop->index+1]->id}}">
        <button type="submit" class="btn btn-warning">DOWN</button>
    </form>
@else 
    <button type="button" class="btn btn-secondary" disabled>DOWN</button>
@endif