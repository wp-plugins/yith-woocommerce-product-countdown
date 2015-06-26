// DATE PICKER FIELDS
jQuery(function ($) {

    /**
     * Date picker in Product Sales Countdown Tab whith overvriting previous instruction
     */

    $('.sale_price_dates_fields input').datepicker('destroy');

    $('.variable_pricing .sale_price_dates_fields input').not('#_sale_price_dates_from, .sale_price_dates_from').addClass('sale_price_dates_to');

    var dates = $('.sale_price_dates_fields input, .sales_countdown_dates_fields input');

    dates.datepicker({
        defaultDate    : '',
        dateFormat     : 'yy-mm-dd',
        numberOfMonths : 1,
        showButtonPanel: true,
        onSelect       : function (selectedDate) {
            var option = $(this).is('#_sale_price_dates_from, .sale_price_dates_from, #_sale_price_dates_from_ywpc') ? 'minDate' : 'maxDate';

            var instance = $(this).data('datepicker'),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);

            if (option == 'minDate') {
                $('#_sale_price_dates_to, .sale_price_dates_to, #_sale_price_dates_to_ywpc').datepicker('option', option, date);
            } else {
                $('#_sale_price_dates_from, .sale_price_dates_from, #_sale_price_dates_from_ywpc').datepicker('option', option, date);
            }

            if ($(this).is('#_sale_price_dates_from, .sale_price_dates_from, #_sale_price_dates_from_ywpc')) {

                var now_date = new Date,
                    start_date = new Date($(this).val()),
                    checkbox = $('#_ywpc_enabled');

                if ((start_date > now_date) && !ywpc.pre_schedule) {
                    checkbox.attr('checked', false).prop('disabled', true);
                } else {
                    checkbox.prop('disabled', false);
                }

            }

            if ($(this).is('#_sale_price_dates_from_ywpc')) {

                $('#_sale_price_dates_from, .sale_price_dates_from').val($(this).val());

            } else if ($(this).is('#_sale_price_dates_to_ywpc')) {

                $('#_sale_price_dates_to, .sale_price_dates_to').val($(this).val());

            } else if ($(this).is('#_sale_price_dates_from')) {

                $('#_sale_price_dates_from_ywpc').val($(this).val());

            } else if ($(this).is('#_sale_price_dates_to')) {

                $('#_sale_price_dates_to_ywpc').val($(this).val());

            }

        }

    });

    $(document).ready(function () {

        if (!ywpc.pre_schedule) {

            var now_date = new Date,
                start_date_1 = new Date($('#_sale_price_dates_from, .sale_price_dates_from').val()),
                start_date_2 = new Date($('#_sale_price_dates_from_ywpc, .sale_price_dates_from_ywpc').val()),
                checkbox = $('#_ywpc_enabled');

            if ((start_date_1 > now_date) && (start_date_2 > now_date)) {
                checkbox.attr('checked', false).prop('disabled', true);
            }

        }

    });

});
