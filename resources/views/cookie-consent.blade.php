<?php
$cookie_consent = request()->cookie('cookie_consent');

if (!$cookie_consent)
echo 'missing cookie';

?>

@if(!$cookie_consent || $cookie_consent !== "accepted")
    <link type="text/css" rel="stylesheet" href="{{asset('public/css/cookie.css')}}">
    <div id="cookie-consent" class="cookie-banner" style="display:none">
        <p>This website uses cookies to ensure you get the best experience on our website.</p>
        <p>To leverage all functionalities, it is advisable to accept.</p>
        <button id="decline-cookies" class="btn btn-danger">Decline</button>
        <button id="accept-cookies" class="btn btn-success">Accept</button>
    </div>
    <script type="text/javascript" src="{{asset('public/js/cookie.js')}}"></script>
@endif
