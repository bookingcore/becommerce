<?php  $footer_style = !empty($footer_style) ? $footer_style :  '1'; ?>
@include("layouts.parts.footer.style_".$footer_style)

<?php
    $backtotop = setting_item('demus_enable_scroll');
?>
@if(!empty($backtotop))
<div id="backtotop" onclick="topFunction()"><span><i class="axtronic-icon-angle-up"></i></span></div>
@endif

@include('layouts.parts.side_menu')
<script>
    var mybutton = document.getElementById("backtotop");
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20 ) {
            if(mybutton){
                mybutton.style.display = "block";
            }

            document.getElementById('masthead').classList.add('animate');
        } else {
            if(mybutton){
                mybutton.style.display = "none";
            }

            document.getElementById('masthead').classList.remove('animate');
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
