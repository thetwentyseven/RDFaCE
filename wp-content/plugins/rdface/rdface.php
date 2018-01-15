<?php
/*
Plugin Name: RDFaCE
Plugin URI: http://aksw.org/Projects/RDFaCE
Description: Enables semantic content authoring based on RDFa and Microdata.
Version: 0.71 beta
Author: Ali Khalili
Author URI: http://ali1k.com

Released under the GPL v.2, http://www.gnu.org/copyleft/gpl.html

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
*/
add_action( 'admin_head', 'fb_add_tinymce' );
function fb_add_tinymce() {
    global $typenow;

    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;
	wp_enqueue_script('jquery');
	wp_enqueue_script('myscript3', WP_PLUGIN_URL . '/rdface/mce/rdface/libs/jstree/_lib/jquery.cookie.js');
    add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'fb_add_tinymce_button' );
	add_filter('tiny_mce_before_init', 'my_change_mce_options');
}

// inlcude the js for tinymce
function fb_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['rdface'] = plugins_url( 'mce/rdface/plugin.min.js', __FILE__ );
	$plugin_array['contextmenu'] = plugins_url( 'mce/contextmenu/plugin.min.js', __FILE__ );
    // Print all plugin js path
    //var_dump( $plugin_array );
    return $plugin_array;
}

// Add the button key for address via JS
function fb_add_tinymce_button( $buttons ) {

    array_push( $buttons, '| rdfaceMain rdfaceRun' );
	//$initArray['valid_elements'] = '*[*]';
    // Print all buttons
    //var_dump( $buttons );
    return $buttons;
}
function my_change_mce_options( $init ) {
	$init['valid_elements'] = '*[*]';
	$init['content_css'] = WP_PLUGIN_URL . '/rdface/mce/rdface/css/rdface.css,'.WP_PLUGIN_URL.'/rdface/mce/rdface/schema_creator/schema_colors.css';
    // Super important: return $init!
    return $init;
}
?>
