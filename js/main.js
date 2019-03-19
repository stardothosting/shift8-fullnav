jQuery(document).ready(function($){
	//open/close primary navigation
	$('.fn-primary-nav-trigger').not('.fn-sublevel-trigger').on('click', function(){
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

	//open/close primary navigation if menu option is clicked
    $('.mobile-menu li:not(:has(.fn-sublevel-trigger))').not('.fn-sublevel-trigger').on('click', function(event){
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
    $('.mobile-menu > li > li a').not('.fn-sublevel-trigger').on('click', function(){
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

    // Sub nav behavior
    function subnav() {
        $("[class^=fn-dropdown-subnav]").each(function(index, value){
            var parent_id = $(this).data('parent');
            var children = $("[data-parent=" + parent_id + "]");
            var children_length = children.length;
            $("[data-id=" + parent_id +"]").append(this);
        });
    }

    function subnav_container() {
        $(".fn-dropdown-subnav").wrapAll("<ul class=\"fn-dropdown-content\"></ul>");
    }
    var first_deferred = subnav();
    $.when(first_deferred).done(function() {
        subnav_container();
    });

    // Search icon trigger
    jQuery('.shift8-fullnav-search').click(function(){
      jQuery(this).find('i').toggleClass('search-close','fa-search');
      jQuery('.shift8-fullnav-search-dropdown').animate({
        height: 'toggle',
        opacity: 'toggle'
      });
    });

})
