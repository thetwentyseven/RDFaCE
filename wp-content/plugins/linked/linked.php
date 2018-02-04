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


// Create top-level menu
function linked_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="admin-linked">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <h2>Documentation of Linked Plugin</h2>

    </div>
    <?php
}

// Create top-level menu
function linked_options_page()
{
    add_menu_page(
        'Linked: Semantic Web & WordPress Plugin',
        'Linked Options',
        'manage_options',
        'linked',
        'linked_options_page_html',
        'dashicons-share',
        30
    );
}
add_action('admin_menu', 'linked_options_page');







add_action( 'admin_head', 'fb_add_tinymce' );
function fb_add_tinymce() {
    global $typenow;

    // Only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'fb_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'fb_add_tinymce_button' );
}

// Inlcude the JS for TinyMCE
function fb_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['fb_test'] = plugins_url( '/public/js/tinymce/plugins/linked/plugin.js',__FILE__ );
    // Print all plugin JS path
    var_dump( $plugin_array );
    return $plugin_array;
}

// Add the button key for address via JS
function fb_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'fb_test_button_key' );
    // Print all buttons
    var_dump( $buttons );
    return $buttons;
}








?>
