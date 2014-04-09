(function ($) {
    $(function () {

        $('ul.tabs').delegate('li:not(.current)', 'click', function () {
            $(this).addClass('current').siblings().removeClass('current')
                .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
        })

    })
})(jQuery)

tinyMCEPopup.requireLangPack();

var GrpdocsInsertDialog = {
    init: function () {
        var f = document.forms[0];
        var shortcode;
        jQuery('.diy').click(function () {
            // diy option selected
            var dis = jQuery('.opt').attr('disabled');

            if (dis) {
                jQuery('.opt').attr('disabled', '');
                jQuery('.gray').css('color', 'black');
                jQuery('#shortcode').val('');

            } else {
                jQuery('.opt').attr('disabled', 'disabled');
                jQuery('.gray').css('color', 'gray');
                jQuery('#shortcode').val('[grpdocs_java_viewer url=""]');
            }

        });

        jQuery('.restrict_dl').click(function () {
            update_sc();
        });
        jQuery('.disable_cache').click(function () {
            update_sc();
        });
        jQuery('.bypass_error').click(function () {
            update_sc();
        });
        jQuery('.save').click(function () {
            update_sc();
        });
        jQuery('#insert').click(function () {
            update_sc();
        });

        jQuery('#height').blur(function () {
            update_sc();
        });
        jQuery('#width').blur(function () {
            update_sc();
        });
        jQuery('#url').blur(function () {
            update_sc();
        });
        jQuery('#file_path').blur(function () {
            update_sc();
        });
        jQuery('#folder_path').blur(function () {
            update_sc();
        });


        function update_sc() {
            shortcode = 'grpdocs_java_viewer';

            if (( jQuery('#url').val() != 0 ) & ( jQuery('#url').val() ) != null) {
                shortcode = shortcode + '  url="' + jQuery('#url').val() + '"';
            } else if (jQuery('#url').val() == '') {
                jQuery('#uri-note').html('');
                shortcode = shortcode + ' url=""';
            }

            if (( jQuery('#height').val() != 0 ) & ( jQuery('#height').val() ) != null) {
                shortcode = shortcode + '  height="' + jQuery('#height').val() + '"';
            }
            if (( jQuery('#width').val() != 0 ) & ( jQuery('#width').val() ) != null) {
                shortcode = shortcode + '  width="' + jQuery('#width').val() + '"';
            }
            if (( jQuery('#file_path').val() != 0 ) & ( jQuery('#file_path').val() ) != null) {
                shortcode = shortcode + '  file_path="' + jQuery('#file_path').val() + '"';
            }
            if (( jQuery('#folder_path').val() != 0 ) & ( jQuery('#folder_path').val() ) != null) {
                shortcode = shortcode + '  folder_path="' + jQuery('#folder_path').val() + '"';
            }
            console.log(jQuery('#folder_path').val());
            var newsc = shortcode.replace(/  /g, ' ');

            jQuery('#shortcode').val('[' + newsc + ']');
        }
    },
    insert: function () {
        if (jQuery('#shortcode').val() == '') {
            shortcode = 'grpdocs_java_viewer';

            if (( jQuery('#url').val() != 0 ) & ( jQuery('#url').val() ) != null) {
                shortcode = shortcode + '  url="' + jQuery('#url').val() + '"';
            } else if (jQuery('#url').val() == '') {
                jQuery('#uri-note').html('');
                shortcode = shortcode + ' url=""';
            }

            if (( jQuery('#height').val() != 0 ) & ( jQuery('#height').val() ) != null) {
                shortcode = shortcode + '  height="' + jQuery('#height').val() + '"';
            }
            if (( jQuery('#width').val() != 0 ) & ( jQuery('#width').val() ) != null) {
                shortcode = shortcode + '  width="' + jQuery('#width').val() + '"';
            }
            if (( jQuery('#file_path').val() != 0 ) & ( jQuery('#file_path').val() ) != null) {
                shortcode = shortcode + '  file_path="' + jQuery('#file_path').val() + '"';
            }
            if (( jQuery('#folder_path').val() != 0 ) & ( jQuery('#folder_path').val() ) != null) {
                shortcode = shortcode + '  folder_path="' + jQuery('#folder_path').val() + '"';
            }
            console.log(jQuery('#folder_path').val());
            var newsc = shortcode.replace(/  /g, ' ');

            jQuery('#shortcode').val('[' + newsc + ']');
        }

        // insert the contents from the input into the document
        tinyMCEPopup.editor.execCommand('mceInsertContent', false, jQuery('#shortcode').val());
        tinyMCEPopup.close();

    }
};

tinyMCEPopup.onInit.add(GrpdocsInsertDialog.init, GrpdocsInsertDialog);

