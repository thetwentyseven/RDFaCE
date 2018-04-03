<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package attirant
 */
 
 get_header();

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>
	
<div id="primary-home">
	<?php
		dynamic_sidebar( 'sidebar-main' );  
	 ?>
</div>


<?php
	get_footer(); 
?>