<?php
/**
 * 
 *	Template Name: Front Page
 *
 * @package attirant
 */
 
 get_header();

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>
	
<div id="primary">
	<?php
		dynamic_sidebar( 'sidebar-main' );  
	 ?>
</div>


<?php
	get_footer(); 
?>