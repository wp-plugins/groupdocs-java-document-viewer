<?php

/*
Plugin Name: GroupDocs.Viewer for Java | HTML5 Document Viewer
Plugin URI: http://www.groupdocs.com/
Description: With this plugin you can seamlessly integrate <a href="http://groupdocs.com/java/document-viewer-library" target="_blank">GroupDocs' Java document viewer functionality</a> into your WordPress website. This will allow you to embed and display PDF, Microsoft Office and over 45 other type of documents right on your WordPress website.
Author: GroupDocs Team <support@groupdocs.com>
Author URI: http://www.groupdocs.com/
Version: 1.0.2
License: GPLv2
*/

include_once('grpdocs-functions.php');


function groupdocs_viewer_java_getdocument($atts) {


extract(shortcode_atts(array(
    'url' => '',
    'width' => '',
    'height' => '',
    'file_path' => '',
    'folder_path' => '',
), $atts));
    $url = trim(strip_tags($url));
    //Add backslash to end of the URL
    if (substr($url, -1) != "/") {
        $url = $url . "/";
    }

    return  '
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=libs/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=libs/jquery-ui-1.10.3.min.js"></script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=libs/knockout-2.2.1.js"></script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=libs/turn.min.js"></script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=libs/modernizr.2.6.2.Transform2d.min.js"></script>
    <script type="text/javascript">
        if (!window.Modernizr.csstransforms){
                var scriptLoad = document.createElement("script");
                scriptLoad.setAttribute("type","text/javascript");
                scriptLoad.setAttribute("src", "' . $url . 'GetJsHandler?script=libs/turn.html4.min.js");
                document.getElementsByTagName("head")[0].appendChild(scriptLoad);
            }
    </script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=installableViewer.min.js"></script>
    <script type="text/javascript">$.ui.groupdocsViewer.prototype.applicationPath = \'' . $url . '\';</script>
    <script type="text/javascript">$.ui.groupdocsViewer.prototype.useHttpHandlers = true ;</script>
    <script type="text/javascript" src="' . $url . 'GetJsHandler?script=GroupdocsViewer.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="' . $url . 'GetCssHandler?script=bootstrap.css">
    <link rel="stylesheet" type="text/css" href="' . $url . 'GetCssHandler?script=GroupdocsViewer.all.min.css">
    <link rel="stylesheet" type="text/css" href="' . $url . 'GetCssHandler?script=jquery-ui-1.10.3.dialog.min.css">
    <script>
        $(function() {
            var localizedStrings = null;
            var thumbsImageBase64Encoded = null;
            $(\'#test\').groupdocsViewer({ filePath: \'' . base64_encode($folder_path . $file_path) . '\',
                                           docViewerId: \'doc_viewer1\',
                                           quality: 100,
                                           showThumbnails: true,
                                           openThumbnails: true,
                                           initialZoom: 100,
                                           zoomToFitWidth: true,
                                           zoomToFitHeight: false,
                                           width: 1000,
                                           height: 500,
                                           backgroundColor: \'\',
                                           showFolderBrowser: true,
                                           showPrint: true,
                                           showDownload: true,
                                           showZoom: true,
                                           showPaging: true,
                                           showViewerStyleControl: true,
                                           showSearch: true,
                                           preloadPagesCount: 0,
                                           viewerStyle: 1,
                                           supportTextSelection: true,
                                           usePdfPrinting: false,
                                           localizedStrings: localizedStrings,
                                           thumbsImageBase64Encoded: thumbsImageBase64Encoded,
                                           toolbarButtonsBoxShadowStyle: \'\',
                                           toolbarButtonsBoxShadowHoverStyle: \'\',
                                           thumbnailsContainerBackgroundColor: \'\',
                                           thumbnailsContainerBorderRightColor: \'\',
                                           toolbarBorderBottomColor: \'\',
                                           toolbarInputFieldBorderColor: \'\',
                                            toolbarButtonBorderColor: \'\',
                                            toolbarButtonBorderHoverColor: \'\',
                                            thumbnailsContainerWidth: 0,
                                            jqueryFileDownloadCookieName: \'jqueryFileDownloadJSForGD\',
                                            showDownloadErrorsInPopup: true,
                                            showImageWidth: false,
                                            showHeader: true,
                                            minimumImageWidth: 0,
                                            enableStandardErrorHandling: true

                                           });
        });
    </script>
    <body>
    <h1>GroupDocs Viewer for Java</h1>
    <div id="test" style="width:' . $width . 'px;height:' . $height . 'px;overflow:hidden;position:relative;margin-bottom:20px;background-color:gray;border:1px solid #ccc;"></div>
    </body>
    ';

}

//activate shortcode
add_shortcode('grpdocs_java_viewer', 'groupdocs_viewer_java_getdocument');


// editor integration

// add quicktag
add_action( 'admin_print_scripts', 'groupdocs_viewer_java_admin_print_scripts' );

// add tinymce button
add_action('admin_init','groupdocs_viewer_java_mce_addbuttons');

// add an option page
add_action('admin_menu', 'groupdocs_viewer_java_option_page');

register_uninstall_hook( __FILE__, 'groupdocs_viewer_java_deactivate' );

function groupdocs_viewer_java_deactivate()
{
	delete_option('gd_viewer_java');		

}
function groupdocs_viewer_java_option_page() {
	global $groupdocs_viewer_java_settings_page;

	$groupdocs_viewer_java_settings_page = add_options_page('GroupDocs Java Viewer', 'GroupDocs Java Viewer', 'manage_options', basename(__FILE__), 'groupdocs_viewer_java_options');

}
function groupdocs_viewer_java_options() {
	if ( function_exists('current_user_can') && !current_user_can('manage_options') ) die(t('An error occurred.'));
	if (! user_can_access_admin_page()) wp_die('You do not have sufficient permissions to access this page');

	require(ABSPATH. 'wp-content/plugins/groupdocs-java-document-viewer/options.php');
}
