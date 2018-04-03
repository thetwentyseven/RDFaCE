
 <div id="slider-wrapper">
	<ul class="bxslider">
		<?php 
		for($i = 1; $i <= 3; $i++) { 
			$s = 'attirant-slide_' . $i;
			$d = 'attirant-desc-' . $i;
			$u = 'attirant-url-' . $i;
		?>	
			<li><div class="slide">
				<?php if ( get_theme_mod( $u ) ) {?>
				<a href="<?php echo esc_url( get_theme_mod($u) ); ?>">
				<?php } ?>		
				<img src="<?php echo get_theme_mod( $s ); ?>">	
			<?php if ( get_theme_mod( $u ) ) { ?>
			</a>
			<?php } ?>
			<?php if (get_theme_mod( $d ) ) { ?>
			<div class="slide_caption">
				<?php if ( get_theme_mod( $u ) ) {?>
				<a href="<?php echo esc_url( get_theme_mod($u) ); ?>">
				<?php } ?>
					<p><?php echo get_theme_mod($d); ?> </p>
				<?php if ( get_theme_mod( $u ) ) { ?>
				</a>
				<?php } ?>
					</div>
					<?php } ?>
					</div>
			 </li>
		<?php } ?>
	</ul>
</div>