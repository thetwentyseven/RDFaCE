<?php
/**
 * attirant functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package attirant
 */

if ( ! function_exists( 'attirant_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function attirant_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on attirant, use a find and replace
	 * to change 'attirant' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'attirant', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'attirant' ),
	) );
	
	add_image_size('attirant-featured-thumb','400','300', true);
	add_image_size('attirant-blog-thumb','500','300', true);
	add_image_size('attirant-single', '1440', '400', true);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'attirant_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'attirant_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function attirant_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'attirant_content_width', 640 );
}
add_action( 'after_setup_theme', 'attirant_content_width', 0 );

function attirant_fonts_url() {
    $fonts_url = '';
    
    $muli = _x('on', 'Muli font: on or off', 'attirant');
    
    $lato	= _x('on', 'Lato font: on or off', 'attirant');

	if ( 'off' !== $muli || 'off'	!== $lato ) {
	    $font_families = array();
	
	    if ('off' !== $muli ) {
		    $font_families[] = 'Muli:300,400';
	    }
	    
	    if ('off' !== $lato ) {
		    $font_families[] = 'Lato:300,400,900';
	    }
	    
		$query_args = array(
		    'family' => urlencode( implode( '|', $font_families ) ),
		    'subset' => urlencode( 'latin,latin-ext' ),
		);
	}
	
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
 
    return $fonts_url;
}

function attirant_scripts_styles() {
    wp_enqueue_style( 'attirant-fonts', attirant_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'attirant_scripts_styles' );

/**
 * Enqueue the stylesheet.
 */
function ving_customizer_stylesheet() {

    wp_register_style( 'ving-customizer-css', get_template_directory_uri() . '/assets/skins/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'ving-customizer-css' );

}
add_action( 'customize_controls_print_styles', 'ving_customizer_stylesheet' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function attirant_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'attirant' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Home', 'attirant' ),
		'id'            => 'sidebar-main',
		'description'   => __('This Sidebar displays the sections of the Static Front Page. Only use AT-Slider, AT-Featured Area and AT-Recent Posts widgets in this sidebar.', 'attirant'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 1', 'attirant' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 2', 'attirant' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 3', 'attirant' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'attirant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function attirant_scripts() {
	wp_enqueue_style( 'attirant-style', get_stylesheet_uri() );
	
	wp_enqueue_style('attirant-bootstrap-style',get_template_directory_uri()."/assets/bootstrap/css/bootstrap.min.css", array('attirant-style'));
	
	wp_enqueue_style('attirant-main-skin',get_template_directory_uri()."/assets/skins/main.css", array('attirant-bootstrap-style'));
	
	wp_enqueue_style('attirant-font-awesome', get_template_directory_uri()."/assets/font-awesome/css/font-awesome.min.css", array('attirant-main-skin'));
	
	wp_enqueue_style('attirant-slider', get_template_directory_uri()."/assets/slider/jquery.bxslider.css", array('attirant-font-awesome'));
	
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'attirant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'attirant-custom-js', get_template_directory_uri() . '/js/custom.js', array(), true );
	
	wp_enqueue_script('nav-js', get_template_directory_uri()."/js/jquery.slicknav.min.js", array(), true);
	
	wp_enqueue_script( 'slider-js', get_template_directory_uri() . '/js/jquery.bxslider.js', array(), true );

	wp_enqueue_script( 'attirant-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'attirant_scripts' );


// retrieves the attachment ID from the file URL
function attirant_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

function attirant_show_more() { 

	$page_for_posts	= get_option( 'page_for_posts'	); ?>
	
	<div class="show-more">
		<a href="<?php echo esc_url( get_page_link( $page_for_posts ) ); ?>"><?php _e('Show More Posts','attirant'); ?></a>
	</div>
<?php
}

function attirant_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf( __( '<cite class="fn">%s</cite>', 'attirant' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','attirant' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo esc_html( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s','attirant'), get_comment_date() ); ?></a><?php edit_comment_link( __( '(Edit)','attirant' ), '  ', '' );
		?>
	</div>

	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

function attirant_custom_mod() {
	echo "<style>";
		echo ".site-description {color: " . get_theme_mod('attirant-desc-color', '#ffffff') . "; }";
	echo "</style>";
}

add_action('wp_head', 'attirant_custom_mod');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


require get_template_directory() . '/widgets/at-featured.php';


require get_template_directory() . '/widgets/at-slider.php';

require get_template_directory() . '/widgets/at-recent.php';
