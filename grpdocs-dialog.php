<?php
if (floatval(phpversion()) < 5.3) {
    echo "Your PHP version is lower than 5.3 while this plugin require PHP 5.3 or higher. <br /> Please, update your PHP version first.";
    return;
}

// access wp functions externally
require_once('bootstrap.php');
//the check on exist tiny_mce_popup.js file
if (file_exists('../../../wp-includes/js/tinymce/tiny_mce_popup.js')){
    $tiny = '<script type="text/javascript" src="../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>';
}else{
    $tiny = '<script type="text/javascript" src="js/tiny_mce_popup.js"></script>';
}
ini_set('display_errors', '0');
error_reporting(E_ALL | E_STRICT);

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>GroupDocs Java Viewer Embedder</title>
        <script type="text/javascript" src="js/jquery-1.5.min.js"></script>
        <?php echo $tiny ?>
        <script type="text/javascript" src="js/grpdocs-dialog.js"></script>    

        <link href="css/grpdocs-dialog.css" type="text/css" rel="stylesheet"/>

    </head>
    <body>
    <form id='form' onsubmit="" method="post" action="" enctype="multipart/form-data">

        <table>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Server url</strong><br/></td>
                <td valign="top"><input name="gd_java_viewer" type="text" class="opt dwl" id="url" style="width:300px;"
                                        value="<?php echo get_option('gd_viewer_java'); ?>"/><br/>
                    <span id="uri-note"></span></td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Folder path</strong><br/></td>
                <td valign="top"><input name="folder_path" type="text" class="opt dwl" style="width:300px;" id="folder_path"
                                        value = "<?php echo get_option('gd_folder_path'); ?>"/><br/>
                    <span id="uri-note"></span></td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>File name</strong><br/></td>
                <td valign="top"><input name="file_path" type="text" class="opt dwl" style="width:300px;" id="file_path"/><br/>
                    <span id="uri-note"></span></td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Height</strong></td>
                <td valign="top" style="width:200px;"><input name="height" type="text" class="opt dwl" id="height"
                                                             size="6" style="text-align:right" value="700"/>px
                </td>
            </tr>
            <tr>
                <td align="right" class="gray dwl_gray"><strong>Width</strong></td>
                <td valign="top"><input name="width" type="text" class="opt dwl" id="width" size="6"
                                        style="text-align:right" value="600"/>px
                </td>
            </tr>           
        </table>  
        <fieldset>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td colspan="2">
                        <br/>
                        Shortcode Preview
                        <textarea name="shortcode" cols="65" rows="3" id="shortcode"></textarea>
                    </td>
                </tr>
            </table>
        </fieldset>
        <div class="mceActionPanel">
            <div style="float: left">
                <input type="button" id="insert" name="insert" value="Insert"
                       onclick="GrpdocsInsertDialog.insert();" />

            </div>

            <div style="float: right">
                <input type="button" id="cancel" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();"/>
            </div>
        </div>
    </form>

    </body>
    </html>


