<?php

if ( ! defined( 'GRPDOCS_PLUGIN_URL' ) )  define( 'GRPDOCS_PLUGIN_URL', WP_PLUGIN_URL . '/groupdocs-java-document-viewer');



function groupdocs_viewer_java_mce_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;

   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "groupdocs_viewer_java_add_tinymce_plugin");
     add_filter('mce_buttons', 'groupdocs_viewer_java_register_mce_button');
   }
}

function groupdocs_viewer_java_register_mce_button($buttons) {
   array_push($buttons, "separator", "groupdocs_viewer_java");
   return $buttons;
}

function groupdocs_viewer_java_add_tinymce_plugin($plugin_array) {
	// Load the TinyMCE plugin
   $plugin_array['groupdocs_viewer_java'] = GRPDOCS_PLUGIN_URL.'/js/grpdocs_plugin.js';
   return $plugin_array;
}

function groupdocs_viewer_java_admin_print_scripts($arg) {
	global $pagenow;
	if (is_admin() && ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) ) {
		$js = GRPDOCS_PLUGIN_URL.'/js/grpdocs-quicktags.js';
		wp_enqueue_script("grpdocs_qts", $js, array('quicktags') );
	}
}

// footer credit
function grpdocs_viewer_java_admin_footer() {
	$pdata = get_plugin_data(__FILE__);
	printf('%1$s plugin | Version %2$s<br />', $pdata['Title'], $pdata['Version']);
}
