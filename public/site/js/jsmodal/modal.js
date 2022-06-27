(function ($) {
    $(document).ready(function(){
        $("#mainpop").addClass("show");
    },2500);
    
    $(".modal_close").click(function(){
        $(".modal_wrap").removeClass("show");
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            $(".modal_wrap").removeClass("show");
        }
    });   
})(jQuery);