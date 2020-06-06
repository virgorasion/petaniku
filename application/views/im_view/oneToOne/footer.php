<?php
/**
 * Created by PhpStorm.
 * User: Farhad Zaman
 * Date: 1/15/2018
 * Time: 11:23 PM
 */
?>

<script>
$(".click-chat li").click(function(){
    $(".mobile-list").addClass("show-chat");
    $(".tab-placement").addClass("show-chat");
});
$(".back").click(function(){
    $(".mobile-list").removeClass("show-chat");
    $(".tab-placement").removeClass("show-chat");
});


$(".slide-contact").click(function(){
    $(".mobile-customize-chat").toggleClass("height-all");
    $(".chat-contact").toggleClass("slide");
});
$(".open-contact").click(function(){
    $(".mobile-customize-chat").toggleClass("height-all");
    $(".chat-contact").toggleClass("slide");
});
$(".open-chat").click(function(){
    $(this).closest(".each-chat").toggleClass("slide");
});
$(".min-chat").click(function(){
    $(this).closest(".each-chat").removeClass("slide");
});
$(".close-chat").click(function(){
    $(this).closest(".each-chat").remove();
});

$(".chat-settings").click(function(){
    $(this).next(".settings-drop").toggleClass("show-set");
});
</script>
</body>
</html>