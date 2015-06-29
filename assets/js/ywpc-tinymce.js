jQuery(function ($) {

    //TinyMCE Button
    var image_url = '';
    tinymce.create('tinymce.plugins.YITH_WooCommerce_Product_Countdown', {
        init : function(ed, url) {
            ed.addButton('ywpc_shortcode', {
                title : 'Add Shortcode',
                image : url+'/../images/icon_shortcode.png',
                onclick : function() {
                    $('#ywpc_shortcode').click();
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo      : function () {
            return {
                longname : 'YITH WooCommerce Product Countdown',
                author   : 'YITHEMES',
                authorurl: 'http://yithemes.com/',
                infourl  : 'http://yithemes.com/',
                version  : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('ywpc_shortcode', tinymce.plugins.YITH_WooCommerce_Product_Countdown);

});
