
<?php

/**
 * Custom option and settings
 */
function linked_settings_init() {
   // register a new setting for "linked" page
   register_setting( 'linked', 'linked_options' );

   // register a new section in the "linked" page
   add_settings_section(

   );

   // register a new field in the "linked_section_developers" section, inside the "linked" page
   add_settings_field(

   );
}

/**
 * register our linked_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'linked_settings_init' );









// show error/update messages
settings_errors( 'linked_messages' );
?>
<div class="admin-linked">
    <h1><?= esc_html(get_admin_page_title()); ?></h1>
    <h2>Documentation of Linked Plugin</h2>
    <p>In order to make this plugin work, you need to register in <a href="https://www.textrazor.com/" target="_blank">TextRazor</a>. Then you will received a
    key by email. Place the API key below and save it.</p>
    <form action="options.php" method="post">
    <?php
    // output security fields for the registered setting "linked"
    settings_fields( 'linked' );
    // output setting sections and their fields
    // (sections are registered for "linked", each field is registered to a specific section)
    do_settings_sections( 'linked' );
    // output save settings button
    submit_button( 'Save Settings' );
    ?>
    </form>
</div>
