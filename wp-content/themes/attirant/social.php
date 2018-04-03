<?php
/**
 * The social icon template of the theme.
 *
 * @package attirant
 */
?>

<div id="social-icons" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<?php 
	$s = array(
				"facebook",
				"twitter",
				"google-plus",
				"instagram",
				"youtube",
				"pinterest-p",
				"envelope-o"
			  );
			  
	$t = array(
				"Facebook",
				"Twitter",
				"Google Plus",
				"Instagram",
				"Youtube",
				"Pinterest",
				"Mail"
			);
			  
	for($u = 0; $u < 7; $u++) {
		if (get_theme_mod($s[$u])) {
	?>
		<a target="_blank" href="<?php echo esc_url( get_theme_mod($s[$u]) ); ?>" title="<?php echo esc_attr($t[$u]); ?>"><i class="fa fa-<?php echo $s[$u] ?>"></i></a>
	<?php }
	}
	?>

</div>