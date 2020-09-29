jQuery(document).ready(function($) {
	

	/* Go to parent link of a dropdown menu if clicked when dropdown menu is open */
	$('.dropdown-toggle[href], .dropdown-submenu > a[href]').click(function(){
		if ( $(this).parent().hasClass('open') ) window.location = $(this).attr('href');
	});

	/* Multi-level dropdown menu on mobile */
	$('.dropdown-submenu > a[href]').click(function(e){
		if ( $(window).width() <= 991 ) {
			e.preventDefault(); event.stopPropagation();
			$('.dropdown-submenu', $(this).parents('.dropdown-menu') ).removeClass('open');
			$(this).parent().toggleClass('open');

			$('.dropdown-menu', $(this).parents('.dropdown-menu') ).hide();
			$(this).siblings('.dropdown-menu').show();
		}
	});


	/* Sticky navbar */
	if ( grapheneJS.enableStickyMenu ) {
		window.heightBreakpoint = $('.navbar').position().top;
		if ( $('#wpadminbar').length > 0 && $(window).width() >= 768 ) window.heightBreakpoint -= 32;
		
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			// if ( franzJS.hasTopBar ) {
			// 	var topBarHeight = $('.top-bar').outerHeight();
			// 	if ( height > topBarHeight ) { $('.navbar').addClass('navbar-fixed-top'); $('body').addClass('navbar-fixed'); }
			// 	else { $('.navbar').removeClass('navbar-fixed-top'); $('body').removeClass('navbar-fixed'); }
			// 	heightBreakpoint += topBarHeight;
			// }
			
			if ( height > window.heightBreakpoint ) { 
				$('body').addClass('navbar-pinned');
				$('.navbar').addClass('navbar-fixed-top');
			} else { 
				if ( ! $('body').hasClass('navbar-persistent-pinned') ) {
					$('body').removeClass('navbar-pinned'); 
					$('.navbar').removeClass('navbar-fixed-top');
				}
			}
		});


		/* Adjust the width of the navbar to match the parent container */
		adjustNavbarWidth();
		$(window).resize(function(){adjustNavbarWidth();});
		$('body > .container').resize(function(){adjustNavbarWidth();});
	}

	function adjustNavbarWidth(){
		if ( $('.boxed-wrapper').length > 0 ) {
			parentWidth = $('.boxed-wrapper').outerWidth();
			$('.boxed-wrapper .navbar').width(parentWidth);
		}
	}


	/* Live search */
	if ( ! grapheneJS.disableLiveSearch ) {
		$('.live-search-input input').autocomplete({
		    serviceUrl				: grapheneJS.siteurl + '/?autocomplete=post',
		    deferRequestBy			: 200,
		    showNoSuggestionNotice	: true,
		    noSuggestionNotice 		: grapheneJS.txtNoResult,
		    onSearchStart: function (query) {
		    	$(this).siblings('.live-search-icon').show();
		    },
		    onSearchComplete: function (query, suggestions) {
		    	$(this).siblings('.live-search-icon').hide();
		    },
		    onSelect: function (suggestion) {
		        window.location.href = suggestion.data;
		    }
		});

		/* bbPress */
		$('input[name="bbp_search"]').wrap('<div class="bbpress-live-search"></div>');
		$('input[name="bbp_search"]').after('<i class="fa fa-spin fa-circle-o-notch live-search-icon" style="display:none"></i>');
		$('.bbpress-live-search input').autocomplete({
		    serviceUrl				: grapheneJS.siteurl + '/?autocomplete=bbpress',
		    deferRequestBy			: 200,
		    showNoSuggestionNotice	: true,
		    noSuggestionNotice 		: grapheneJS.txtNoResult,
		    onSearchStart: function (query) {
		    	$(this).siblings('.live-search-icon').show();
		    },
		    onSearchComplete: function (query, suggestions) {
		    	$(this).siblings('.live-search-icon').hide();
		    },
		    onSelect: function (suggestion) {
		        window.location.href = suggestion.data;
		    }
		});
	}
	

	/* Graphene Slider */
	if ( ! grapheneJS.sliderDisable ) {
		$('.carousel').each(function(){
			$(this).carousel({
				interval: grapheneJS.sliderInterval,
				pause	: 'hover'
			});
			$(this).carousel('cycle');
		});

		// Preload slider background images
		if ( grapheneJS.sliderDisplay == 'bgimage-excerpt' ) {
			$('.carousel .item').each(function(){
				var src = $(this).css('background-image').replace('url(', '').replace(')','');
				if ( src.indexOf('http') == 0 ){
					(new Image()).src = this;
				}
				src = null;
			});
		}

		/* Fix Bootstrap Carousel not pausing on hover */
		$(document).on( 'mouseenter', '.carousel', function() {
			$(this).carousel( 'pause' );
		});
		$(document).on( 'mouseleave', '.carousel', function() {
			$(this).carousel( 'cycle' );
		});

		/* Position the carousel caption when using full-width-boxed layout */
		function graphenePositionCarouselCaption(){
			if ( $(window).width() <= 991 || $('#header-menu-wrap').length == 0 ) return;
			$('.layout-full-width-boxed .carousel-caption-content').css('left', $('#header-menu-wrap').position().left + 15 + 'px' );
		}
		$(window).resize(function(){graphenePositionCarouselCaption();});
		graphenePositionCarouselCaption();
	}


	/* Comments */
	if ( grapheneJS.shouldShowComments ) {
		$('li.comment .comment-permalink').hide();
		$('.comment-wrap').hover( function(){ $('.comment-permalink', this).fadeIn(200); }, function(){ $('.comment-permalink:eq(0)', this).fadeOut(200); });
		$('.comment-form-jump a').click(function(){ $('html,body').animate({scrollTop: $("#respond").offset().top - 200},'slow'); return false;});
		// Tabbed comments
		$("div#comments h4.comments a").click(function(){
			$("div#comments .comments").addClass( 'current' );
			$("div#comments .pings").removeClass( 'current' );
			$("div#comments #pings_list").hide();
			$("div#comments .comments-list-wrapper").fadeIn(300);
			return false;
		});
		$("div#comments h4.pings a").click(function(){
			$("div#comments .pings").addClass( 'current' );
			$("div#comments .comments").removeClass( 'current' );
			$("div#comments .comments-list-wrapper").hide();
			$("div#comments #pings_list").fadeIn(300);
			return false;
		});
	}
				
	
	/**
	 * Infinite scroll
	 */
	$('.infinite-load .load').each(function(){
		$(this).data( 'remaining-posts', $(this).data('totalPosts') - $(this).data('postsPerPage'));
		var infScrollBtnObj = $(this);
		var infScroll = $(this).data('container');
		
		var infScrollOptions = {
			navSelector : $(this).data('navSelector'),
			nextSelector: $(this).data('nextSelector'),
			itemSelector: $(this).data('itemSelector'),
			animate 	: false,
			loading		: {
				msgText		: grapheneGetInfScrollMessage('post', $(this).data('postsPerPage'), $(this).data('remainingPosts')),
				finishedMsg	: grapheneJS.infScrollFinishedText,
				img			: '',
				msg			: null,
				speed		: 400
			},
			// debug		: true
		};

		/* Manually parse the path so that Infinite Scroll will still work even on offset page */
		currentPage = parseInt( $(infScrollOptions.navSelector+' .current').html() );
		infScrollOptions.state = { currPage: currentPage };

		nextURI = $(infScrollOptions.nextSelector).attr('href');
		nextIndex = (currentPage+1).toString();
		suffix = nextURI.slice(-(nextURI.length - nextURI.indexOf(nextIndex)-nextIndex.length));
		pathURI = nextURI.replace(nextIndex+suffix,'');
		infScrollOptions.pathParse = function(path,nextPage){
			path = [pathURI,suffix];
			return path;
		};

		/* Modify the path for reverse Infinite Scroll direction */
		if (  $(this).data('direction') == 'reverse' ) {
			infScrollOptions.direction = $(this).data('direction');
			
			currentPage = parseInt( $(infScrollOptions.navSelector+' .current').html() );
			infScrollOptions.state = { currPage: currentPage };
			
			if ($(infScrollOptions.nextSelector).length > 0) {
				nextURI = $(infScrollOptions.nextSelector).attr('href');
				nextIndex = (currentPage-1).toString();
				
				suffix = nextURI.slice(-(nextURI.length - nextURI.indexOf(nextIndex)-nextIndex.length));
				pathURI = nextURI.replace(nextIndex,'').replace(suffix,'');
	
				infScrollOptions.pathParse = function(path,nextPage){
					path = [pathURI,suffix];
					return path;
				};
			}
		}
		
		$(infScroll).infinitescroll(infScrollOptions, function(newElems, response, path){
			infScrollBtnObj.data('remaining-posts', infScrollBtnObj.data('remainingPosts') - parseInt(newElems.length));
			
			if ( infScrollBtnObj.data('method') == 'click' ) infScrollBtnObj.html(grapheneGetInfScrollBtnLbl(infScrollBtnObj.data('remainingPosts')));
			else infScrollBtnObj.html(grapheneGetInfScrollMessage('post', infScrollBtnObj.data('postsPerPage'), infScrollBtnObj.data('remainingPosts')));

			if ( $(infScroll).data('masonry') ) {
				var $newElems = $( newElems ).css({ opacity: 0 }); 		// hide new items while they are loading
				$('p.infinite-load').css('margin-top', '2000px');			// push the loading button down while the new items are loading
				$(infScroll).imagesLoaded(function(){						// ensure that images load before adding to masonry layout
					$newElems.animate({ opacity: 1 });					// show elems now they're ready
					$(infScroll).masonry( 'appended', $newElems, true );
					$('p.infinite-load').css('margin-top', '20px');
				});
			}
			
			if ( infScrollBtnObj.data('remainingPosts') <= 0 ) {
				infScrollBtnObj.html(grapheneJS.infScrollFinishedText).addClass('disabled').removeAttr('href');
				$(infScroll).infinitescroll('destroy');
			}

			$(infScroll).trigger( 'append.infinitescroll', [newElems, response, path] );
		});
		$($(this).data('navSelector')).hide();
		
		if ( $(this).data('method') == 'click' ){
			$(infScroll).infinitescroll('pause');
			$(this).click(function(e){
				e.preventDefault();
				if ($(this).data('remainingPosts') <= 0) return;
				$($(this).data('container')).infinitescroll('retrieve');
				$(this).html(grapheneGetInfScrollMessage('post', $(this).data('postsPerPage'), $(this).data('remainingPosts')));
			});
		} else {
			$(this).html(grapheneGetInfScrollMessage('post', $(this).data('postsPerPage'), $(this).data('remainingPosts')));
		}
	});
	

	/**
	 * Back to top button
	 */
	var backtotop = '#back-to-top';
    if ( $(backtotop).length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                var pageHeight = $(document).height() - $(window).height();

               	if ( scrollTop == pageHeight ) {
               		$(backtotop).removeClass('show');
               	} else if (scrollTop > scrollTrigger) {
                    $(backtotop).addClass('show');
                } else {
                    $(backtotop).removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }


    /* Layout Shortcodes */
    if ( $.isFunction( 'tooltip' ) ) {
    	// Stop "click triggered" tootips from acting as bookmarks to top of page
    	$('[data-toggle="tooltip"]').tooltip().filter('[data-trigger*="click"]').on('click', function(e) {
	        e.preventDefault();
	    });
	}


	/* Masonry for posts layout */
	if ( grapheneJS.isMasonry || $('.posts-list.loop-masonry').length > 0 ) {
		$postsList = $('.loop-masonry .entries-wrapper');
		$postsList.imagesLoaded(function(){
			$postsList.masonry({
				itemSelector: '.post-layout-grid',
				columnWidth: 0.25
			});
		});
	}


	/**
	 * Remember user preference to hide auto column switch notification
	 */
	$('#graphene-auto-column-switch-alert .close').click(function(){
		data = { action: 'graphene-hide-auto-column-switch-alert' };
		$.post(grapheneJS.ajaxurl, data);
	});
});


function grapheneGetInfScrollMessage( type, itemsPerLoad, itemsLeft ){
	type = typeof type !== 'undefined' ? type : 'post';
	
	if (itemsLeft < itemsPerLoad) itemsPerLoad = itemsLeft;
	var message = '';
	
	if ( type == 'post' ) {
		if (itemsLeft > 1) message = grapheneJS.infScrollMsgTextPlural.replace('window.grapheneInfScrollItemsPerPage',itemsPerLoad).replace('window.grapheneInfScrollItemsLeft',itemsLeft);
		else message = grapheneJS.infScrollMsgText.replace('window.grapheneInfScrollItemsPerPage',itemsPerLoad).replace('window.grapheneInfScrollItemsLeft',itemsLeft);
	}
	
	if ( type == 'comment' ) {
		if (itemsLeft > 1) message = grapheneJS.infScrollCommentsMsgPlural.replace('window.grapheneInfScrollCommentsPerPage',itemsPerLoad).replace('window.grapheneInfScrollCommentsLeft',itemsLeft);
		else message = grapheneJS.infScrollCommentsMsg.replace('window.grapheneInfScrollCommentsPerPage',itemsPerLoad).replace('window.grapheneInfScrollCommentsLeft',itemsLeft);
	}
	
	message = '<i class="fa fa-spinner fa-spin"></i> ' + message;
	return message;
}


function grapheneGetInfScrollBtnLbl(itemsLeft){
	var message = '';
	if ( itemsLeft == 0 ) message = grapheneJS.infScrollFinishedText;
	else message = grapheneJS.infScrollBtnLbl;
	return message;
}