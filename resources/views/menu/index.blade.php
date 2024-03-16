

@extends('layouts.header_footer')

@section('content')


<style>
    #menu {
        /* background-color: #3c6e71; */
        /* color:#fff; */
        height: calc(100vh - 106px);
    }

    .menu-category {
        padding:20px;
        display:flex;
        flex-direction:row;
        gap:2rem;
        flex-wrap:wrap;
    }


    .menu-category-item-block {
        border:1px solid #000;
        border-radius:5px;
        margin:10px;
        width:320px;
        height:160px;

        display:flex;
        flex-direction:row;
        align-items:center;
        gap:1rem;

        background-color:#fff;


        user-select:none;
        cursor:pointer;
    }

    .menu-item-image-div> img {
        border-radius:10px;
        margin:5px;
        height:150px;
        width:150px;
    }

    .item-details {
        color:#000;
        display:flex;
        flex-direction:column;
    }


    .set-quantity-div {
        width:100%;
        padding:5px 20px;

        display:flex;
        flex-direction:row;
        justify-content:center;
        gap:0.5rem;
        margin:auto;
        font-weight:bold;
        font-size:2rem;
    }

    .set-quantity-div  p {
        text-align:center;
        user-select:none;
        width:40px;
    }

    .set-quantity-div i {
        cursor:pointer;
    }


    .item-details > .name {
        font-size:1.5rem;
        font-weight:bold;
        max-width:150px;
    }

    .item-details>.weight {
        font-size:1.1rem;
        max-width:150px;
    }

    .item-details>.price {
        font-size:1.6rem;
        font-weight:bold;
    }

    .modal-body > .image {
        display:flex;
        flex-direciton:row;
        justify-content:center;
    }

    .modal-body > .image > img {
        margin:0;
    }

    .modal-body .infos {
        display:flex;
        flex-direction:column;
        padding: 0 30px;
        font-weight:bold;
        font-size:2rem;
    }

    .modal-body::-webkit-scrollbar {
        width:0px;
    }
    
    .modal-body::-moz-scrollbar {
        width:0px;
    }

    .modal-body::-ms-scrollbar {
        width:0px;
    }

    .modal-footer.add-to-cart {
        display:flex;
        justify-content:center;
    }

    .modal-footer.add-to-cart>button {
        width:40%;
    }


</style>

<div id="menu" class="overflow-auto">
    
    @foreach($categories as $category)
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
    
    @endforeach
</div>

<script>
    const change_quantity_price = (id, price, increment = false) => {

        let input = document.getElementById('quantity-'+id);
        let text = document.getElementById('text-quantity-' + id);

        let finalPrice = document.getElementById('price-' + id);


        if (increment) {
            if (input.value >= 10) {
                alert('Maximum quantity is 10');
                input.value = 10;
            } else {
                input.value++;
            }
        } else {
            if (input.value <=1) {
                alert('Minimum quantity is 1');
                input.value = 1;
            } else {
                input.value--;
            }
        }
        text.innerText = input.value;
        finalPrice.innerText = input.value * price;
    }
</script>

@endsection
