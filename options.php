<?php

//  If the user does not have the required permissions...
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}
// Get GroupDocs plug-in options from database.
$gd_viewer_java = get_option('gd_viewer_java');
$folder_path = get_option('gd_folder_path');
//  If data was posted to the page...
if (isset($_POST['grpdocs_submit_hidden']) && $_POST['grpdocs_submit_hidden'] == 1) {

    $gd_viewer_java = trim(strip_tags($_POST['url']));
    $folder_path = trim(strip_tags($_POST['folder_path']));
    //Add backslash to end of the URL
    if (substr($folder_path, -1) != "/") {
        $folder_path = $folder_path . "/";
    }
    if (substr($gd_viewer_java, -1) != "/") {
        $gd_viewer_java = $gd_viewer_java . "/";
    }
    update_option('gd_viewer_java', $gd_viewer_java);
    update_option('gd_folder_path', $folder_path);
    // Display an 'updated' message.
    ?>
    <div class="updated"><p><strong><?php _e('Settings saved!', 'menu-test'); ?></strong></p></div>
<?php

}


?>

<div>

	<h2>GroupDocs Options</h2>


    <form name="form" method="post" action="" type = "hidden">

		<input type="hidden" name="grpdocs_submit_hidden" value="1">
		<table>
        <tr><td>GroupDocs.Viewer for Java v.1.8.0 plugin url:</td>
        <td><input type="text" size="50px" name="url" value="<?php echo $gd_viewer_java; ?>"></td></tr>
        <tr><td>The absolute path to folder, which was configured in GroupDocs.Viewer for Java v.1.8.0 in config file:</td>
        <td><input type="text" size="50px" name="folder_path" value="<?php echo $folder_path; ?>"></td></tr>
		</table>

		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
		</p>

	</form>

</div>
