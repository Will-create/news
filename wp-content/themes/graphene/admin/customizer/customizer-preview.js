jQuery(document).ready(function($) {

	/* Add a custom style element to add our styling */
	$('head').append('<style type="text/css" id="graphene-preview-css"></style>');

	/* Site title and description */
	wp.customize('blogname', function(value){ value.bind(function(to){
		if ( $('.navbar-header .header_title a').length > 0 ) $('.navbar-header .header_title a').html( to );
		else $('.navbar-header .header_title').html( to );
	});	});

	wp.customize('blogdescription', function(value){ value.bind(function(to){
		$('.navbar-header .header_desc').html( to );
	});	});

	wp.customize('graphene_settings[header_text_align]', function(value){ value.bind(function(to){
		$('.navbar > .navbar-header').prop('class', 'navbar-header align-' + to);
	});	});

	/* Header text colour */
	wp.customize('header_textcolor', function(value){ value.bind(function(to){
		$('.header_title, .header_desc').remove();
		if ( to !== 'blank' ) {
			$('.navbar-header').append('<h1 class="header_title">' + wp.customize.value('blogname')() + '</h1>');
			$('.navbar-header').append('<h2 class="header_desc">' + wp.customize.value('blogdescription')() + '</h1>');
			$('#graphene-preview-css').append('.header_title, .header_title a, .header_title a:visited, .header_title a:hover, .header_desc {color:' + to + '}');
		}
	});	});

	/* Contextual navigation title */
	wp.customize('graphene_settings[section_nav_title]', function(value){ value.bind(function(to){
		if ( to != '' ) $('.contextual-nav .section-title-sm').html(to);
		else $('.contextual-nav .section-title-sm').html(grapheneCustomizerPreview.sectionNavTitle);
	});	});
  
  	/* Header image height */
	wp.customize('graphene_settings[header_img_height]', function(value){ value.bind(function(to){
		$('#header').css('max-height', to + 'px');
	}); });

  	/* Slider height */
	wp.customize('graphene_settings[slider_height]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('@media (min-width: 768px){.carousel, .carousel .item{height:' + to + 'px;}}');
	});	});

	/* Slider height (mobile) */
	wp.customize('graphene_settings[slider_height_mobile]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('@media (max-width: 767px){.carousel, .carousel .item{height:' + to + 'px;}}');
	});	});


	/* Mentions bar */
	wp.customize('graphene_settings[mentions_bar_title]', function(value){value.bind(function(to){
		if ( to == '' ) $('.mentions-bar .highlight-title').remove();
		else {
			if ( $('.mentions-bar .highlight-title').length < 1 ) $('.mentions-bar').prepend('<h2 class="highlight-title"></h2>');
			$('.mentions-bar .highlight-title').html(to);
		}
	});	});

	wp.customize('graphene_settings[mentions_bar_desc]', function(value){value.bind(function(to){
		if ( to == '' ) $('.mentions-bar .description').remove();
		else {
			if ( $('.mentions-bar .description').length < 1 ) {
				if ( $('.mentions-bar .highlight-title').length < 1 ) $('.mentions-bar').prepend('<div class="description"></div>');
				else $('.mentions-bar .highlight-title').after('<div class="description"></div>');
			}
			$('.mentions-bar .description').html('<p>' + to + '</p>');
		}
	});	});
	
	/* Copyright text */
	wp.customize('graphene_settings[copy_text]', function(value){
		value.bind(function(to){
			$('#copyright').html(to);
		});
	});

	/* Container width */
	wp.customize('graphene_settings[container_width]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('@media (min-width: 1200px) {.container {width:' + to + 'px}}');
		$('.boxed-wrapper .navbar').css('width', to + 'px');
	});	});

	/* Columns width */
	wp.customize('graphene_settings[column_width]', function(value){ value.bind(function(to){
		colWidths = JSON.parse(to);

		/* Get the current column mode */
		colMode = '';
		if ( $('body').hasClass('two_col_right') ) colMode = 'two-col-right';
		if ( $('body').hasClass('three_col_right') ) colMode = 'three-col-right';
		if ( $('body').hasClass('three_col_center') ) colMode = 'three-col-center';
		
		if ( $('#sidebar1, #sidebar2').length == 0 ) return;

		$("#content-main, #sidebar1, #sidebar2").removeClass(function (index, className) {
		    return (className.match(/\bcol-md-(pull-)?(push-)?\d+/g) || []).join(' ');
		});

		if ( $('#sidebar1, #sidebar2').length == 1 ) {
			/* Two-column mode */
			$('#content-main').addClass('col-md-' + colWidths.two_col.content);
			$('#sidebar1').addClass('col-md-' + colWidths.two_col.sidebar);
			$('#sidebar2').addClass('col-md-' + colWidths.two_col.sidebar);

			if ( colMode == 'two-col-right' ) {
				$('#sidebar2').addClass('col-md-pull-' + colWidths.two_col.content);
				$('#content-main').addClass('col-md-push-' + colWidths.two_col.sidebar);
			}

		} else {
			/* Three-column mode */
			$('#content-main').addClass('col-md-' + colWidths.three_col.content);
			$('#sidebar1').addClass('col-md-' + colWidths.three_col.sidebar_right);
			$('#sidebar2').addClass('col-md-' + colWidths.three_col.sidebar_left);

			if ( colMode == 'three-col-right' ) {
				$('.sidebar').addClass('col-md-pull-' + colWidths.three_col.content);
				$('#content-main').addClass('col-md-push-' + ( parseInt( colWidths.three_col.sidebar_left ) + parseInt( colWidths.three_col.sidebar_right ) ) );
			}

			if ( colMode == 'three-col-center' ) {
				$('.sidebar-left').addClass('col-md-pull-' + colWidths.three_col.content);
				$('#content-main').addClass('col-md-push-' + colWidths.three_col.sidebar_left );
			}
		}

	});	});

	
	/**
	 * Colours
	 */
	
	/* Top Bar */
	wp.customize('graphene_settings[top_bar_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.top-bar {background-color:' + to + '}');
	});	});


	/* Primary Menu */
	wp.customize('graphene_settings[menu_primary_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar {background:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_primary_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar-inverse .nav > li > a, #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-menu-item > a.mega-menu-link {color:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_primary_active_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #header-menu-wrap .nav li:focus, .navbar #header-menu-wrap .nav li:hover, .navbar #header-menu-wrap .nav li.current-menu-item, .navbar #header-menu-wrap .nav li.current-menu-ancestor, .navbar #header-menu-wrap .dropdown-menu li, .navbar #header-menu-wrap .dropdown-menu > li > a:focus, .navbar #header-menu-wrap .dropdown-menu > li > a:hover, .navbar #header-menu-wrap .dropdown-menu > .active > a, .navbar #header-menu-wrap .dropdown-menu > .active > a:focus, .navbar #header-menu-wrap .dropdown-menu > .active > a:hover, .navbar #header-menu-wrap .navbar-nav>.open>a, .navbar #header-menu-wrap .navbar-nav>.open>a:focus, .navbar #header-menu-wrap .navbar-nav>.open>a:hover, .navbar .navbar-nav>.active>a, .navbar .navbar-nav>.active>a:focus, .navbar .navbar-nav>.active>a:hover, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu li.mega-current-menu-item, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-menu-item > a.mega-menu-link:hover, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-toggle-on > a.mega-menu-link, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-current-menu-item > a.mega-menu-link {background:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_primary_active_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #header-menu-wrap .navbar-nav>.active>a, .navbar #header-menu-wrap .navbar-nav>.active>a:focus, .navbar #header-menu-wrap .navbar-nav>.active>a:hover, .navbar #header-menu-wrap .navbar-nav>.open>a, .navbar #header-menu-wrap .navbar-nav>.open>a:focus, .navbar #header-menu-wrap .navbar-nav>.open>a:hover, .navbar #header-menu-wrap .navbar-nav>.current-menu-item>a, .navbar #header-menu-wrap .navbar-nav>.current-menu-item>a:hover, .navbar #header-menu-wrap .navbar-nav>.current-menu-item>a:focus, .navbar #header-menu-wrap .navbar-nav>.current-menu-ancestor>a, .navbar #header-menu-wrap .navbar-nav>.current-menu-ancestor>a:hover, .navbar #header-menu-wrap .navbar-nav>.current-menu-ancestor>a:focus, .navbar #header-menu-wrap .navbar-nav>li>a:focus, .navbar #header-menu-wrap .navbar-nav>li>a:hover, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu li.mega-current-menu-item, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-menu-item > a.mega-menu-link:hover, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-toggle-on > a.mega-menu-link, #header-menu-wrap #mega-menu-wrap-Header-Menu #mega-menu-Header-Menu > li.mega-current-menu-item > a.mega-menu-link {color:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_primary_dd_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar-inverse .nav ul li a {color:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_primary_dd_active_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar-inverse .nav .dropdown-menu li:hover > a, .navbar-inverse .nav .dropdown-menu li.current-menu-item > a, .navbar-inverse .nav .dropdown-menu li.current-menu-ancestor > a {color:' + to + '}');
	});	});


	/* Secondary Menu */
	wp.customize('graphene_settings[menu_sec_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap {background:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap, .navbar-inverse .dropdown-submenu > .dropdown-menu {border-color:' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu > li > a {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_active_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap .nav li:focus, .navbar #secondary-menu-wrap .nav li:hover, .navbar #secondary-menu-wrap .nav li.current-menu-item, .navbar #secondary-menu-wrap .nav li.current-menu-ancestor, .navbar #secondary-menu-wrap .dropdown-menu li, .navbar #secondary-menu-wrap .dropdown-menu > li > a:focus, .navbar #secondary-menu-wrap .dropdown-menu > li > a:hover, .navbar #secondary-menu-wrap .dropdown-menu > .active > a, .navbar #secondary-menu-wrap .dropdown-menu > .active > a:focus, .navbar #secondary-menu-wrap .dropdown-menu > .active > a:hover, .navbar #secondary-menu-wrap .navbar-nav>.open>a, .navbar #secondary-menu-wrap .navbar-nav>.open>a:focus, .navbar #secondary-menu-wrap .navbar-nav>.open>a:hover {background-color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_active_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap .navbar-nav>.active>a, .navbar #secondary-menu-wrap .navbar-nav>.active>a:focus, .navbar #secondary-menu-wrap .navbar-nav>.active>a:hover, .navbar #secondary-menu-wrap .navbar-nav>.open>a, .navbar #secondary-menu-wrap .navbar-nav>.open>a:focus, .navbar #secondary-menu-wrap .navbar-nav>.open>a:hover, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-item>a, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-item>a:hover, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-item>a:focus, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-ancestor>a, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-ancestor>a:hover, .navbar #secondary-menu-wrap .navbar-nav>.current-menu-ancestor>a:focus, .navbar #secondary-menu-wrap .navbar-nav>li>a:focus, .navbar #secondary-menu-wrap .navbar-nav>li>a:hover {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_dd_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap .nav ul li a {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[menu_sec_dd_active_item]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.navbar #secondary-menu-wrap .nav .dropdown-menu li:hover > a, .navbar #secondary-menu-wrap .nav .dropdown-menu li.current-menu-item > a, .navbar #secondary-menu-wrap .nav .dropdown-menu li.current-menu-ancestor > a {color: ' + to + '}');
	});	});


	/* Slider */
	wp.customize('graphene_settings[slider_caption_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.carousel-caption {background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[slider_caption_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.carousel-caption, .carousel .slider_post_title, .carousel .slider_post_title a {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[slider_card_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.carousel.style-card {background: ' + to + '}');
	});	});
	wp.customize('graphene_settings[slider_card_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.carousel.style-card {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[slider_card_link]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.carousel.style-card a {color: ' + to + '}');
	});	});


	/* Content Area */
	wp.customize('graphene_settings[content_wrapper_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#content, body > .container > .panel-layout, #header {background-color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[content_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.post, .singular .post {background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[meta_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.entry-footer {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[content_font_colour]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('body, blockquote p {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[title_font_colour]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.post-title, .post-title a, .post-title a:hover, .post-title a:visited {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[link_colour_normal]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('a, .post .date .day, .pagination>li>a, .pagination>li>a:hover, .pagination>li>span, #comments > h4.current a, #comments > h4.current a .fa, .post-nav-top p, .post-nav-top a {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[link_colour_hover]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('a:focus, a:hover, .post-nav-top a:hover {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[sticky_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.sticky {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[child_page_content_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.child-page {background-color: ' + to + ';}');
	});	});


	/* Widgets */
	wp.customize('graphene_settings[widget_item_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.sidebar .sidebar-wrap {background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[widget_header_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.sidebar .sidebar-wrap {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[widget_list]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.sidebar ul li {border-color: ' + to + '}');
	});	});
	

	/* Buttons and Labels */
	wp.customize('graphene_settings[button_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.btn, .btn:focus, .btn:hover, .Button, .colour-preview .button, input[type="submit"], button[type="submit"], #commentform #submit, .wpsc_buy_button, #back-to-top {background: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[button_label]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.btn, .btn:focus, .btn:hover, .Button, .colour-preview .button, input[type="submit"], button[type="submit"], #commentform #submit, .wpsc_buy_button, #back-to-top {color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[label_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.label-primary, .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover, .list-group-item.parent, .list-group-item.parent:focus, .list-group-item.parent:hover {background: ' + to + '; border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[label_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.label-primary, .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover, .list-group-item.parent, .list-group-item.parent:focus, .list-group-item.parent:hover {color: ' + to + ';}');
	});	});


	/* Archives */
	wp.customize('graphene_settings[archive_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.post-nav-top, .archive-title, .page-title, .term-desc {background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[archive_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.post-nav-top, .archive-title, .page-title, .term-desc {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[archive_label]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.archive-title span {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[archive_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('.page-title, .archive-title, .term-desc {color: ' + to + '}');
	});	});


	/* Comments */
	wp.customize('graphene_settings[comments_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#comments .comment, #comments .pingback, #comments .trackback {background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[comments_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#comments .comment, #comments .pingback, #comments .trackback {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[comments_box_shadow]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#comments .comment, #comments .pingback, #comments .trackback {box-shadow: 0 0 3px ' + to + ';}');
	});	});
	wp.customize('graphene_settings[comments_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#comments .comment, #comments .pingback, #comments .trackback {color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[author_comments_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#comments ol.children li.bypostauthor, #comments li.bypostauthor.comment {border-color: ' + to + '}');
	});	});


	/* Footer */
	wp.customize('graphene_settings[footer_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#footer, .graphene-footer{background-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[footer_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#footer, .graphene-footer{color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[footer_link]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#footer a, #footer a:visited {color: ' + to + '}');
	});	});
	wp.customize('graphene_settings[footer_widget_bg]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#sidebar_bottom {background: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[footer_widget_border]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#sidebar_bottom {border-color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[footer_widget_text]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#sidebar_bottom {color: ' + to + ';}');
	});	});
	wp.customize('graphene_settings[footer_widget_link]', function(value){ value.bind(function(to){
		$('#graphene-preview-css').append('#sidebar_bottom a, #sidebar_bottom a:visited {color: ' + to + '}');
	});	});

});