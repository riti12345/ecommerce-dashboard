
 $(window).scroll(function() {
    if ($(this).scrollTop()>0){
        $('.fixed-action-btn').fadeOut();
    }
    else {
        $('.fixed-action-btn').fadeIn();
    }
});
$(document).ready(function(){
    $(window).scroll(function() {
        if ($(this).scrollTop()>0){
            $('.a').fadeOut();
        }
        else {
            $('.a').fadeIn();
        }
    });
}); // Document ready closes

