<?php
/**
 * attirant Theme Customizer.
 *
 * @package attirant
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function attirant_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize-> add_setting(
    'attirant-desc-color',
    array(
	    'default'			=> '#ffffff',
    	'sanitize_callback'	=> 'sanitize_hex_color',
    	'transport'			=> 'postMessage',
    	)
    );
    
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'attirant-desc-color',
	        array(
	            'label' => __('Site Description Color','attirant'),
	            'section' => 'colors',
	            'settings' => 'attirant-desc-color',
                'priority'  => 12
	        )
	    )
	);
	
	$wp_customize-> add_section(
    'attirant_social',
    array(
    	'title'			=> __('Social Settings','attirant'),
    	'description'	=> __('Manage the Social Icon Settings of your site.','attirant'),
    	'priority'		=> 3,
    	)
    );
    
    $wp_customize-> add_setting(
    'social',
    array(
    	'default'			=> false,
    	'sanitize_callback'	=> 'attirant_sanitize_checkbox',
    	)
    );
    
    $wp_customize-> add_control(
    'social',
    array(
    	'type'		=> 'checkbox',
    	'label'		=> __('Enable Social Icons','attirant'),
    	'section'	=> 'attirant_social',
    	'priority'	=> 1,
    	)
    );

    $wp_customize-> add_setting(
    'facebook',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'facebook',
    array(
    	'label'		=> __('Facebook URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 3,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );
    
    $wp_customize-> add_setting(
    'twitter',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'twitter',
    array(
    	'label'		=> __('Twitter URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 4,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );
    
    $wp_customize-> add_setting(
    'google-plus',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'google-plus',
    array(
    	'label'		=> __('Google Plus URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 5,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );
    
    $wp_customize-> add_setting(
    'instagram',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'instagram',
    array(
    	'label'		=> __('Instagram URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 6,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );
    
    $wp_customize-> add_setting(
    'pinterest-p',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'pinterest-p',
    array(
    	'label'		=> __('Pinterest URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 7,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );
    
    $wp_customize-> add_setting(
    'youtube',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'youtube',
    array(
    	'label'		=> __('Youtube URL','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 8,
        'active_callback'	=> 'attirant_social_enable'
    	)
    ); 
    
    $wp_customize-> add_setting(
    'envelope-o',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'envelope-o',
    array(
    	'label'		=> __('E-Mail','attirant'),
    	'section'	=> 'attirant_social',
    	'type'		=> 'text',
        'priority'   => 8,
        'active_callback'	=> 'attirant_social_enable'
    	)
    );   
    
     function attirant_social_enable() {
	    if ( get_theme_mod('social', false ) ) {
		    return true;
	    } else {
		    return false;
	    }
    } 
	
/*---- Showcase Area Settings ----*/

	$wp_customize->add_panel(
    'attirant-showcase', 
    	array(
		    'priority'       => 12,
		    'capability'     => 'edit_theme_options',
		    'theme_supports' => '',
		    'title'          => __('Featured Area Settings', 'attirant'),
		)
	);
	
	$wp_customize-> add_section(
    'attirant-showcase-enable',
    array(
    	'title'			=> __('Enable Featured Area','attirant'),
    	'description'	=> __('T<i>o Enable Featured Area on Front Page (Template), just drag it in Home Sidebar in Widgets Section</i>', 'attirant'),
    	'priority'		=> 1,
    	'panel'			=> 'attirant-showcase',
    	)
    );
    
    $wp_customize->add_setting(
	    'attirant-showcase-blog',
	    array(
	        'default' => true,
	        'sanitize_callback'	=> 'attirant_sanitize_checkbox',
	    )
	);
 
	$wp_customize->add_control(
	    'attirant-showcase-blog',
	    array(
	        'type' => 'checkbox',
	        'label' => __('Enable Featured Area on the Blog Page','attirant'),
	        'section' => 'attirant-showcase-enable',
	    )	    
	);
    
    $wp_customize->add_section(
	    'attirant-showcase-1',
	    array(
		    'title'		=> __('Featured Item 1','attirant'),
		    'priority'	=> 1,
		    'panel'		=> 'attirant-showcase',
		    'active_callback'	=> 'attirant_fa_enable'
	    )
    );
    
    $wp_customize->add_setting( 
    'attirant-s-img-1', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-s-img-1',
	        array(
	            'label' => __('Image Upload','attirant'),
	            'section' => 'attirant-showcase-1',
	            'settings' => 'attirant-s-img-1',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-title-1', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-title-1', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-showcase-1',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-url-1', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-url-1', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-showcase-1',
		'type'		=> 'text',
		)
	);
	
	$wp_customize->add_section(
	    'attirant-showcase-2',
	    array(
		    'title'		=> __('Featured Item 2','attirant'),
		    'priority'	=> 2,
		    'panel'		=> 'attirant-showcase',
		    'active_callback'	=> 'attirant_fa_enable'
	    )
    );
    
    $wp_customize->add_setting( 
    'attirant-s-img-2', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-s-img-2',
	        array(
	            'label' => __('Image Upload','attirant'),
	            'section' => 'attirant-showcase-2',
	            'settings' => 'attirant-s-img-2',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-title-2', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-title-2', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-showcase-2',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-url-2', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-url-2', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-showcase-2',
		'type'		=> 'text',
		)
	);
	
	$wp_customize->add_section(
	    'attirant-showcase-3',
	    array(
		    'title'		=> __('Featured Item 3','attirant'),
		    'priority'	=> 2,
		    'panel'		=> 'attirant-showcase',
		    'active_callback'	=> 'attirant_fa_enable'
	    )
    );
    
    $wp_customize->add_setting( 
    'attirant-s-img-3', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-s-img-3',
	        array(
	            'label' => __('Image Upload','attirant'),
	            'section' => 'attirant-showcase-3',
	            'settings' => 'attirant-s-img-3',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-title-3', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-title-3', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-showcase-3',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-s-url-3', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-s-url-3', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-showcase-3',
		'type'		=> 'text',
		)
	);
	
	function attirant_fa_enable() {
	    if ( get_theme_mod( 'attirant-showcase-blog', false ) ) {
		    return true;
	    } else {
		    return false;
	    }
    }
	
/*---- Slider Settings ----*/
	
	 $wp_customize-> add_panel(
    'attirant-slider', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Slider', 'attirant'),
    'description'    => '',
    ));
    
    $wp_customize-> add_section(
    'attirant-slides',
    array(
    	'title'			=> __('Enable Slider','attirant'),
    	'description'	=> __('<i>To Enable Slider on Front Page (Template), just drag it in Home Sidebar in Widgets Section</i>', 'attirant'),
    	'priority'		=> 3,
    	'panel'			=> 'attirant-slider',
    	)
    );
    
    $wp_customize->add_setting(
	    'attirant-slider-blog',
	    array(
	        'default' => true,
	        'sanitize_callback'	=> 'attirant_sanitize_checkbox',
	    )
	);
 
	$wp_customize->add_control(
	    'attirant-slider-blog',
	    array(
	        'type' => 'checkbox',
	        'label' => __('Enable Slider on the Blog Page','attirant'),
	        'section' => 'attirant-slides',
	    )	    
	);
	
	$wp_customize-> add_section(
    'attirant-slider-settings', array(
    	'title'		=> __('Slider Settings', 'attirant'),
    	'panel'		=> 'attirant-slider',
    	'active_callback'	=> 'attirant_slider_enable'
    	)
    );
    
    $wp_customize->add_setting(
    	'slider-mode',
    	array(
    		'default'	=> 'horizontal',
    		'sanitize_callback'	=> 'attirant_sanitize_select',
    	)
    );
    
    $wp_customize->add_control(
    	'slider-mode',
    	array(
    		'type'		=> 'select',
    		'priority'	=> 1,
    		'label'	=> __('Select the transition you want for the slider','attirant'),
    		'section'	=> 'attirant-slider-settings',
    		'choices'	=> array(
    							'fade'			=> 'Fade',
    							'horizontal'	=> 'Horizontal',	
    						)
    	)
    );
    
    $wp_customize->add_setting(
    	'attirant-slider-speed',
    	array(
    		'default'	=> 500,
    		'sanitize_callback'	=> 'absint'
    	)
    );
    
    $wp_customize->add_control(
    	'attirant-slider-speed',
    	array(
    		'type'			=> 'range',
    		'priority'		=> 2,
    		'section'		=> 'attirant-slider-settings',
    		'label'			=> __('Slider Speed','attirant'),
    		'description'	=> __('500-5000ms','attirant'),
    		'input_attrs'	=> array(
    			'min'	=> 500,
    			'max'	=> 5000,
    			'step'	=> 500,
    			'class'	=> 'test-class test',
    			'style'	=> '#abcdef'
    		)
    	)
    );
	    
    $wp_customize-> add_section(
    'attirant-slide-1', array(
    	'title'		=> __('Slide 1', 'attirant'),
    	'panel'		=> 'attirant-slider',
    	'active_callback'	=> 'attirant_slider_enable'
    	)
    );
    
    $wp_customize->add_setting( 
    'attirant-slide_1', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-slide_1',
	        array(
	            'label' => __('Slide Upload','attirant'),
	            'section' => 'attirant-slide-1',
	            'settings' => 'attirant-slide_1',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'attirant-desc-1', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-desc-1', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-slide-1',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-url-1', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-url-1', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-slide-1',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_section(
    'attirant-slide-2', array(
    	'title'		=> __('Slide 2', 'attirant'),
    	'panel'		=> 'attirant-slider',
    	'active_callback'	=> 'attirant_slider_enable'
    	)
    );
    
	$wp_customize->add_setting( 
    'attirant-slide_2', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-slide_2',
	        array(
	            'label' => __('Slide Upload','attirant'),
	            'section' => 'attirant-slide-2',
	            'settings' => 'attirant-slide_2',
	        )
	    )
	);
		
	$wp_customize-> add_setting( 
	'attirant-desc-2', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-desc-2', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-slide-2',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-url-2', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-url-2', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-slide-2',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_section(
    'attirant-slide-3', array(
    	'title'		=> __('Slide 3', 'attirant'),
    	'panel'		=> 'attirant-slider',
    	'active_callback'	=> 'attirant_slider_enable'
    	)
    );
    
	$wp_customize->add_setting( 
    'attirant-slide_3', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'attirant-slide_3',
	        array(
	            'label' => __('Slide Upload','attirant'),
	            'section' => 'attirant-slide-3',
	            'settings' => 'attirant-slide_3',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'attirant-desc-3', array(
			'sanitize_callback'	=> 'attirant_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-desc-3', array(
		'label'		=> __('Description','attirant'),
		'section'	=> 'attirant-slide-3',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_setting( 
	'attirant-url-3', array(
			'sanitize_callback'	=> 'esc_url_raw',
			 )
	);
	
	$wp_customize-> add_control(
	'attirant-url-3', array(
		'label'		=> __('URL','attirant'),
		'section'	=> 'attirant-slide-3',
		'type'		=> 'text',
		)
	);
	
	function attirant_slider_enable() {
	    if ( get_theme_mod( 'attirant-slider-blog', false ) ) {
		    return true;
	    } else {
		    return false;
	    }
    }
	
	//---- Pro Settings ----//
	
	class attirant_Review_Control extends WP_Customize_Control {   
		
		public $type = 'attirant-options';
		 
	    public function render_content() {
	        ?>
	        <li><h2 class="dvt-title"><?php _e('<i>Check out more of the Awesome WordPress Themes at Divjot.Co </i>', 'attirant'); ?></p><a class="button attirant_dvt" href="http://www.divjot.co" target="_blank" title="<?php esc_attr_e('Divjot.Co', 'attirant'); ?>"><?php printf('Divjot.Co', 'attirant'); ?></a></li>
			<br>
			<li><p class="rev-title"><?php _e('<i>If you liked the theme, spare a few minutes to Review Attirant Plus</i>', 'attirant'); ?></p><a class="button attirant_rev" href="https://www.wordpress.org/themes/attirant" target="_blank" title="<?php esc_attr_e('Rate the Theme', 'attirant'); ?>"><?php printf('Review attirant Theme', 'attirant'); ?></a></li>
			<br>
			<li><h2 class="pro-title"><?php _e('<b>Enjoying the Theme? Upgrade to Attirant Plus and enjoy much much more of the awesomeness of Attirant</b>', 'attirant'); ?></h2><a class="button attirant_pro" href="http://www.inkhive.com/product/attirant-plus" target="_blank" title="<?php esc_attr_e('Attirant Plus', 'attirant'); ?>"><?php printf('Check out Attirant Plus', 'attirant'); ?></a></li>
								
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'attirant_pro',
    array(
    	'title'			=> __('Theme Links','attirant'),
    	'priority'		=> 1,
    	)
    );
    
    $wp_customize-> add_setting(
	    'attirant_review',
		array(
			'sanitize_callback'	=> 'esc_url_raw'
		)
    );
    
    $wp_customize->add_control(
	    new attirant_Review_Control(
		    $wp_customize,
                'attirant_review', array(
                'section' => 'attirant_pro',
                'type' => 'attirant-options',
            )
	    )
    );
	
	function attirant_sanitize_checkbox( $i ) {
	    if ( $i == 1 ) {
	        return 1;
	    } 
	    else {
	        return '';
	    }
	 }
	 
	 function attirant_sanitize_select($a) {
		$valid = array(
            'fade'			=> 'Fade',
            'horizontal'	=> 'Horizontal',
             );
	        
	        if (array_key_exists($a, $valid)) {
		        return $a;
		        } 
		        else {
		        return '';
		    }
	 }
	 
	 function attirant_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	if ( $wp_customize->is_preview() ) {
	    add_action( 'wp_footer', 'attirant_customize_preview', 21);
	}
	
	function attirant_customize_preview() {
    ?>
    <script type="text/javascript">
        ( function( jQuery ) {
            wp.customize('attirant-desc-color',function( value ) {
                value.bind(function(to) {
                    jQuery('.site-description').css('color', to );
                });
            });
             wp.customize('header_textcolor',function( value ) {
                value.bind(function(to) {
                    jQuery('.site-title a').css('color', to );
                });
            });
        } )( jQuery )
    </script>
    <?php
}  // End function attirant_customize_preview()
	
}
add_action( 'customize_register', 'attirant_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function attirant_customize_preview_js() {
	wp_enqueue_script( 'attirant_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'attirant_customize_preview_js' );
