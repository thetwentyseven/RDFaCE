<?php
/**
 * @package Linked
 * @version 1.0
 */
/*
Plugin Name: Linked
Plugin URI: https://linked.thetwentyseven.co.uk/
Description: This is a plugin to generate automatically linked connections with raw text from post and pages.
Author: Adrian Vazquez
Version: 1.0
Author URI: https://thetwentyseven.co.uk/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  linked

Linked is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Linked is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Linked. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

// Create global instances
define( 'LINKED_PLUGIN', __FILE__ );
define( 'LINKED_PLUGIN_DIR', untrailingslashit( dirname( LINKED_PLUGIN ) ) );


add_action( 'admin_init', 'linked_settings_init' );
function linked_settings_init() {
   // register a new setting for "linked" page
   register_setting( 'linked_options_menu', 'linked_options_data' );

   // register a group
   add_settings_section( 'linked_options_id', __( 'Configuration', 'linked_options_menu' ), 'setting_section_callback', 'linked_options_menu' );

   // add fields
   add_settings_field('linked_options_apikey', __( 'Add action API Key: ', 'linked_options_menu' ), 'setting_apikey_callback', 'linked_options_menu', 'linked_options_id');

   add_settings_field('linked_options_confidence', __( 'Confidence: ', 'linked_options_menu' ), 'setting_confidence_callback', 'linked_options_menu', 'linked_options_id');

}


// Create top-level in admin menu
add_action('admin_menu', 'linked_options_admin_page');
function linked_options_admin_page(){
    add_menu_page(
        'Linked: Semantic Web & WordPress Plugin', // $page_title
        'Linked Options', // $menu_title
        'manage_options', // $capability
        'linked_options_menu', // $menu_slug. The slug name to refer to this menu by. Should be unique for this menu page.
        'linked_options_admin_page_content', // $function. The function to be called to output the content for this page
        'dashicons-share', // $icon_url
        30 // $position
    );

}


// Settings API, display for admin users in the panel admin
function linked_options_admin_page_content(){
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    if ( isset( $_GET['settings-updated'] ) ) {
    // add settings saved message with the class of "updated"
    add_settings_error( 'linked_messages', 'linked_message', __( 'Settings Saved', 'linked_options_menu' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'linked_messages' );

    require_once LINKED_PLUGIN_DIR . '/admin/view.php';
}


// Adding a new tinymce button with 'mce_buttons' filter and his JS plugin with 'mce_external_plugins' filter
add_action( 'admin_head', 'linked_tinymce' );
function linked_tinymce() {
    global $typenow;

    // Only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'linked_tinymce_plugin' );
    add_filter( 'mce_buttons', 'linked_tinymce_button' );
}

// Include the JS for TinyMCE
function linked_tinymce_plugin( $plugin_array ) {
    $plugin_array['linked'] = plugins_url( '/public/js/tinymce/plugins/linked/plugin.js',__FILE__ );
    return $plugin_array;
}

// Add the button key for address via JS
function linked_tinymce_button( $buttons ) {
    array_push( $buttons, 'linked_button_key' );
    return $buttons;
}


// Enqueue files for the plugin to manage data via AJAX.
// 'admin_enqueue_scripts' Just enqueue for the admin panel - More info: https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
add_action( 'admin_enqueue_scripts', 'linked_admin_enqueue' );
function linked_admin_enqueue() {

  // Register JavaScript
  wp_register_script( 'linked-plugin-script', null);
  wp_enqueue_script( 'linked-plugin-script');

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'linked-plugin-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),
                                                                    'content' => '',
                                                                    'highlight' => '',
                                                                    'api' => '')
                                                                  );
}


// These files would be reflected within the TinyMCE visual editor
// More info: https://developer.wordpress.org/reference/functions/add_editor_style/
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
function wpdocs_theme_add_editor_styles() {
    add_editor_style( plugins_url( '/public/css/style.css', __FILE__ )  );
}


// Enqueue the files for the frontend
// More info: https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'linked_frontend_enqueue' );
function linked_frontend_enqueue() {

  wp_register_style( 'linked-plugin-style', plugins_url( '/public/css/style.css', __FILE__ ) );
  wp_enqueue_style( 'linked-plugin-style' );
}


// Include the settings page with all the files required
require_once LINKED_PLUGIN_DIR . '/settings.php';

?>
