<h1 style="margin:10px 0 -15px 30px; user-select:none">{{$category->name}}</h1>
<div class="menu-category">
    @foreach($category->food as $food)
        <div class="menu-category-item-block" data-bs-toggle="modal" data-bs-target="#view-menu-item-{{$food->id}}">
            <div class="menu-item-image-div">
                <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="{{$food->name}}">
            </div>
            <div class="item-details">
                <p class="name text-truncate">{{$food->name}}</p>
                <p class="weight">{{$food->weight}}g</p>
                <p class="price">{{$food->price}} &euro;</p>
            </div>
        </div>

        @include('menu.menu-item-modal')
    @endforeach
</div>
