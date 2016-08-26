jQuery(document).ready(function($){
    //open/close primary navigation
    $('.fn-primary-nav-trigger').on('click', function(){
        $('.fn-menu-icon').toggleClass('is-clicked');
        $('.fn-header').toggleClass('menu-is-open');

        //in firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        if( $('.fn-primary-nav').hasClass('is-visible') ) {
            $('.fn-primary-nav').removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
                $('body').removeClass('overflow-hidden');
            });
        } else {
            $('.fn-primary-nav').addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
                $('body').addClass('overflow-hidden');
            });
        }
    });
});
