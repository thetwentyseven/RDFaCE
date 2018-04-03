 <div id = "showcase-wrapper" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="container">
				
<?php 
	for($i = 1; $i <= 3 ; $i++ ) { 
		$s	=	'attirant-s-img-'	.	$i;
		$t 	=	'attirant-s-title-'	.	$i;
		$u	=	'attirant-s-url-'	.	$i;
	?>
	<div class = "showcase-box col-lg-4 col-md-4 col-sm-4 col-xs-12">
		
	<?php
		$img_url	= get_theme_mod( $s );
		if ( $img_url ) :
			$img_id		= attirant_get_image_id( $img_url );
		endif;
		
	?>
			<div class = "showcase-image">
				<?php if ( get_theme_mod( $u ) ) { ?>
					<a href = "<?php echo esc_url(get_theme_mod($u) ); ?>">
				<?php } ?>
				
				<?php
					if ( get_theme_mod( $s ) ) { ?>
						<img src = "<?php echo wp_get_attachment_image_src( $img_id, 'attirant-featured-thumb' )[0]; ?>" alt="showcase-image-<?php echo $i; ?>">
					<?php } 
						else 
						{ ?>
							<img src="<?php echo get_template_directory_uri() . '/images/dthumb-2.jpg'; ?>" alt="showcase-image-<?php echo $i; ?>">
					<?php } ?> 
					
				<?php if ( get_theme_mod( $u ) ) { ?>
						</a>
					<?php 
						} 
					?>
				</div>
				
				<?php 
					if ( get_theme_mod( $t) ) {
				?>	
				<div class = "showcase-title">
				<?php
					}
				?>
			<?php if ( get_theme_mod( $u ) ) { ?>
				<a href = "<?php echo esc_url(get_theme_mod($u) ); ?>">
			<?php } 
		?>		
			<?php echo get_theme_mod( $t ); ?>		
	<?php if ( get_theme_mod( $u ) ) { ?>
		</a>
	<?php } ?>
	<?php if ( get_theme_mod( $t) ) {
	?>
	</div>
	<?php } ?>
	</div>
<?php 
}
?>
</div>
</div>
