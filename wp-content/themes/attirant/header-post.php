<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package attirant
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'attirant' ); ?></a>

	<div id="top-bar"></div>
	<header id="masthead-2" class="site-header head-2 container" role="banner">
		<nav id="post-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'attirant' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class'	=> 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		<div class="site-branding col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->
		<?php
			if ( get_theme_mod('social', false) ) {
				get_template_part('social','post');
			}
		?>
	</header><!-- #masthead -->
	
	<?php
		if ( is_single() || is_page() ) : ?>
	
	<?php while ( have_posts() ) : the_post();
		?>
		
		<div class="single-title">
			<?php
		if ( has_post_thumbnail() ): ?>
			<?php echo the_post_thumbnail('attirant-single'); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( get_template_directory_uri()."/images/black.png" ); ?>">			
		<?php endif;
			
		if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		</div>
		
		<?php
	endwhile;
	
	endif;
	
	?>

	<div id="content" class="site-content container">
