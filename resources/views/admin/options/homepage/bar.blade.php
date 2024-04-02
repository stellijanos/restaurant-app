<div id="homepage-images-bar">
    <h1>Homepage images: {{count($images)}} (in total)|</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-homepage-image">
        Add new image
    </button>

    @if(session()->has('create_message'))
        <h4>| {{session()->get('create_message')}}</h4>
    @endif
</div>

@include($source.'create-image-modal')

@if($errors->any())
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif
