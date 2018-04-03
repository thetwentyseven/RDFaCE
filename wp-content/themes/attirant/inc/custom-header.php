<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package attirant
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses attirant_header_style()
 */
function attirant_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'attirant_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1440,
		'height'                 => 900,
		'flex-height'            => true,
		'wp-head-callback'       => 'attirant_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'attirant_custom_header_setup' );

if ( ! function_exists( 'attirant_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see attirant_custom_header_setup().
 */
function attirant_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( HEADER_TEXTCOLOR === $header_text_color && '' == get_header_image() ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; 
	
	// Check if user has defined any header image.
	
		if ( has_header_image() ) :
	?>
		.header-image {
			background: url(<?php echo get_header_image(); ?>) no-repeat #111;
			background-position: center;
			background-size: cover;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
