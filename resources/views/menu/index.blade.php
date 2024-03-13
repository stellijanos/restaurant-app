

@extends('layouts.header_footer')

@section('content')


<style>
    #menu {
        background-color: #3c6e71;
        color:#fff;
        height: calc(100vh - 106px);
    }

    .menu-category {
        padding:20px;
        display:flex;
        flex-direction:row;
    }


    .menu-item-category-block {
        border:1px solid #000;
        border-radius:5px;
        margin:10px;
        width:350px;
        height:175px;

        display:flex;
        flex-direction:row;
        align-items:center;
        gap:1rem;

        background-color:#fff;


        user-select:none;
        cursor:pointer;
    }

    .menu-item-category-block>img {
        border-radius:10px;
    }

    .item-details {
        /* padding:15px; */

        color:#000;

        display:flex;
        flex-direction:column;

    }



</style>

<div id="menu">
    <h1>Menu</h1>

    


    @foreach($categories as $category)
        <h1>{{$category->name}}</h1>

        <div class="menu-category">

            @foreach($category->food as $food)
                <div class="menu-item-category-block" data-bs-toggle="modal" data-bs-target="#view-menu-item-{{$food->id}}">

                    <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="" width="150", height="150">
                   
                    <div class="item-details">
                        <p>{{$food->name}}</p>
                        <p>{{$food->weight}}</p>
                        <p>{{$food->price}}</p>
                    </div>
                </div>

                <div class="modal fade" id="view-menu-item-{{$food->id}}" tabindex="-1" aria-labelledby="view-menu-item-{{$food->id}}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{route('update_admin_profile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="view-menu-item-{{$food->id}}-label">Edit Profile</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('storage/app/public/images/menu_items').'/'.$food->image}}" alt="" width="400", height="400">
                                    <p>{{$food->name}}</p>
                                    <p>{{$food->weight}}</p>
                                    <p>{{$food->price}}</p>
                                </div>

                                <p  class="btn btn-success">
                                    <i class="bi bi-dash" id="remove-item-{{$food->id}}"></i>
                                    <input type="number" style="width:30px;"name="quantity" value="1" min="1" max="10" id="quantity" disabled>
                                    <i class="bi bi-plus" id="remove-item-{{$food->id}}"></i>
                                </p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    
    @endforeach
</div>

@endsection
