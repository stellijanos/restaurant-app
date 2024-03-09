
<div class="menu-item-value-block">
    <input type="number" name="price" pattern="\d*\.?\d*" min="0"  id="food_weight{{$food->id}}" value="{{$food->weight}}" disabled>
    <button type="button" class="btn btn-secondary" id="btn_food_weight_{{$food->id}}">Edit</button>
</div>
