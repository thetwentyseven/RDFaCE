<?php
/*
Plugin Name: Recent Posts Thumbnails

*/
	
function at_register_recent() {
	register_widget( 'at_recent' );
}

add_action('widgets_init', 'at_register_recent');

/*
add_action( 'widgets_init', function(){
     register_widget( 'at_featured' );
});	
*/

/**
 * Adds sk_facebook widget.
 */
class at_recent extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'at_recent', // Base ID
			__('AT - Recent Posts', 'attirant'), // Name
			array( 'description' => __( 'Recent Posts section of the site', 'attirant' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		?>
			
		<?php
       
        echo $args['before_widget'];
                if ( ! empty( $instance['title'] ) ) {
                        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
                }
                ?>
				
				<main id="main" class="site-main container" role="main">

				<?php
				if ( have_posts() ) :
		
					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
		
					<?php
					endif;
		
					/* Start the Loop */
					
					$abc	=	array(
									'post_type'	=> 'post',
									'posts_per_page'	=> 6,
								);
					
					$blog	=	new WP_Query( $abc );
					 
					while ( $blog->have_posts() ) : $blog->the_post();
		
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'front' );
		
					endwhile;
				
				attirant_show_more();
		
				else :
		
					get_template_part( 'template-parts/content', 'none' );
		
				endif; ?>
		
				</main><!-- #main -->
		
		<?php
               
                echo $args['after_widget'];
               
               
        }
 
        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form( $instance ) {  
                       
                if ( isset( $instance[ 'title' ] ) ) {
                        $title = $instance[ 'title' ];
                }
                else {
                        $title = __( 'Recent Posts', 'attirant' );
                }
                      
                ?>
               
                <p>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'attirant' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </p>
               
   		<?php 
	   		
	   		  echo __('The Recent Posts section of the homepage', 'attirant');
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

} // 