$(document).ready(function(){

    $(".togelNav i").click(function(){
        $(".togelNav").slideUp(500);
    });

    $("nav .content .faBars").click(function(){
        $(".togelNav").slideToggle(500);
    });

    $(".control i").click(function(){
        $(".control").toggle(500);
    });
})