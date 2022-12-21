<style>
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section, main {
        display: block;
    }
    body {
        line-height: 1;
    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    /* --------------------------------

    Primary style

    -------------------------------- */
    html * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    *, *:after, *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        font-size: 100%;
        font-family: "Lato", sans-serif;
        color: #8f9cb5;
        background-color: #ffd88f;
    }

    a {
        color: #35a785;
        text-decoration: none;
    }

    /* --------------------------------
    --------------------

    Main components

    -------------------------------- */
    header {
        height: 200px;
        line-height: 200px;
        text-align: center;
        background-color: #5e6e8d;
        color: #FFF;
    }
    header h1 {
        font-size: 20px;
        font-size: 1.25rem;
    }
    .cd-popup-trigger {
        display: block;
        width: 170px;
        height: 50px;
        line-height: 50px;
        margin: 3em auto;
        text-align: center;
        color: #FFF;
        font-size: 14px;
        font-size: 0.875rem;
        font-weight: bold;
        text-transform: uppercase;
        border-radius: 50em;
        background: #35a785;
        box-shadow: 0 3px 0 rgba(0, 0, 0, 0.07);
    }
    /* --------------------------------

    xpopup

    -------------------------------- */
    .cd-popup {
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(94, 110, 141, 0.9);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: opacity 0.3s 0s, visibility 0s 0.3s;
        -moz-transition: opacity 0.3s 0s, visibility 0s 0.3s;
        transition: opacity 0.3s 0s, visibility 0s 0.3s;
    }
    .cd-popup.is-visible {
        opacity: 1;
        visibility: visible;
        -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
        -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
        transition: opacity 0.3s 0s, visibility 0s 0s;
    }

    .cd-popup-container {
        position: relative;
        width: 100%;
        height:100%;
        background: #FFF;
        border-radius: .25em .25em .4em .4em;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        -webkit-transform: translatex(-400px);
        -moz-transform: translatex(-400px);
        -ms-transform: translatex(-400px);
        -o-transform: translatex(-400px);
        transform: translatex(-400px);
        /* Force Hardware Acceleration in WebKit */
        -webkit-backface-visibility: hidden;
        -webkit-transition-property: -webkit-transform;
        -moz-transition-property: -moz-transform;
        transition-property: transform;
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        transition-duration: 0.5s;
    }
    .cd-popup-container p {
        padding: 0px;
        margin:0px;
    }

    .cd-popup-container .cd-popup-close {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 30px;
        height: 30px;
    }
    .cd-popup-container .cd-popup-close::before, .cd-popup-container .cd-popup-close::after {
        content: '';
        position: absolute;
        top: 12px;
        width: 14px;
        height: 3px;
        background-color: #8f9cb5;
    }
    .cd-popup-container .cd-popup-close::before {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
        left: 8px;
    }
    .cd-popup-container .cd-popup-close::after {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
        right: 8px;
    }
    .is-visible .cd-popup-container {
        -webkit-transform: translateX(0);
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -o-transform: translateX(0);
        transform: translateX(0);
    }
</style>
<html>
<a href="#0" id="pop1btn" class="cd-popup-trigger" onclick="openpopup('pop1')">View Pop-up 1</a>
<a href="#0" class="cd-popup-trigger" onclick="openpopup('pop2')" >View Pop-up 2</a>
<a href="#0" class="cd-popup-trigger" onclick="openpopup('pop3')" >View Pop-up 3</a>
<div id="pop1" class="cd-popup" role="alert">
    <div class="cd-popup-container">
        <p>Are you sure you want to delete this element 1 ?</p>
        <a href="#0" class="cd-popup-close"></a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<div id="pop2" class="cd-popup" role="alert">
    <div class="cd-popup-container">
        <p>Are you sure you want to delete this element 2 ?</p>
        <a href="#0" class="cd-popup-close"></a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<div id="pop3" class="cd-popup" role="alert">
    <div class="cd-popup-container">
        <p>Are you sure you want to delete this element 3 ?</p>
        <a href="#0" class="cd-popup-close"></a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
</html>
<script type="text/javascript" src = "./assets/js/jquery.min.js"></script>
<script>
    jQuery(document).ready(function($){

        //close popup
        $('.cd-popup').on('click', function(event){
            if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
                event.preventDefault();
                $(this).removeClass('is-visible');
            }
        });
        //close popup when clicking the esc keyboard button
        $(document).keyup(function(event){
            if(event.which=='27'){
                $('.cd-popup').removeClass('is-visible');
            }
        });
    });

    //open popup
    function openpopup(id) {
        event.preventDefault();
        $("#"+id+"").addClass('is-visible');
    }
</script>