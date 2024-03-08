 <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" name="show" {{ $food->show_on_menu == 1 ? "checked" : ""}}>
    <label for="flexCheckDefault-{{$food->id}}">Show in menu</label>
</div>