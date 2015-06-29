jQuery(function ($) {

    $(window).resize(function () {


        var body = $('body'),
            is_admin = body.hasClass('ywpc-admin'),
            ywpc_bar_height = $('.ywpc-topbar').height(),
            admin_bar_height = (is_admin) ? ( $(window).width() > 782 ? 32 : 46) : 0,
            position = body.hasClass('ywpc-bottom') ? 'bottom' : 'top';

        if (position == 'bottom') {

            body.css('padding-bottom', ywpc_bar_height + 'px')

        } else {

            body.css('padding-top', ywpc_bar_height + 'px');

            switch (ywpc_footer.theme) {
                case 'Twenty Fifteen':

                    if (!body.is('.admin-bar')) {
                        body.addClass('admin-bar');
                        body.append('<div id="wpadminbar"></div>');
                    }

                    $('#wpadminbar').css('height', admin_bar_height + ywpc_bar_height);
                    break;

                case 'Twenty Fourteen':

                    $('#masthead').css('top', ywpc_bar_height + admin_bar_height);
                    break;

                default:

            }


        }

    }).trigger('resize');

});