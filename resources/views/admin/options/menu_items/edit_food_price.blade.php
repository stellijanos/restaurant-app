<div class="menu-item-value-block">
    <input type="number" name="price" pattern="\d*\.?\d*" min="0"  id="food_{{$food->id}}" value="{{$food->price}}" disabled>
    <button type="button" class="btn btn-secondary" id="btn_food_price_{{$food->id}}">Edit</button>
</div>