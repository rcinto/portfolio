<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>


<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js" type="text/javascript"></script>

<script type="text/javascript">
	var container,
			focusElem;
	
	$(function() {
		container = $('#content');
		container.masonry({
			itemSelector: '.post',
			transitionDuration: 500
		});
		
		$('#content article.post').bind('click', postFocus);
	});

	var postFocus = function(event) {
		$(this).css({
			'width': $(this).width()
		});
		
		focusElem = $(this);

		focusElem.initialProperties = {
			height: focusElem.height(), 
			left: focusElem.position().left, 
			top: focusElem.position().top, 
			width: focusElem.width()
		}
		focusElem.addClass('focus');

		focusElem.animate({
			height: 300, 
			left: '23%', 
			top: '0', 
			width: '50%',
			position: 'fixed'
		}, 500, 'easeOutQuad');

		focusElem.unbind('click', postFocus);

		$('#site_modal')
			.height($(document).height())
			.fadeIn('fast')
			.bind('click', postBlur);

		createCloseButton(focusElem);
		
		event.preventDefault();
	}

	var postBlur = function(event) {
		if(focusElem) {
			focusElem.animate(focusElem.initialProperties, 
				500, 'easeOutQuad', function() {
				$('#post_close_button').remove();
				focusElem.removeClass('focus');
				container.masonry('layout');
			})
				.bind('click', postFocus);
			}
		$('#site_modal').fadeOut('slow').unbind('click');
		
		if (event) {
			event.preventDefault();
		}
	}

	var createCloseButton = function(wrapperElement) {
		var closeElement = $('<div id="post_close_button">x</div>');
		closeElement.css({
			'cursor': 		'pointer',
			'position': 	'absolute',
			'width': 			'10px',
			'height': 		'10px',
			'top': 				'-5px',
			'right':			'-5px'
		}).bind('click', postBlur);
		
		$(wrapperElement).prepend(closeElement);
	}

</script>

</head>

<body <?php body_class(); ?>>
<div id="site_modal"></div>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">