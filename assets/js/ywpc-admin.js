// DATE PICKER FIELDS
jQuery(function ($) {

    /**
     * Date picker in Product Sales Countdown Tab
     */
    var dates_ywpc = $('.sales_countdown_dates_fields input');

    dates_ywpc.datepicker({
        defaultDate    : '',
        dateFormat     : 'yy-mm-dd',
        numberOfMonths : 1,
        showButtonPanel: true,
        onSelect       : function (selectedDate) {
            var option = $(this).is('#_sale_price_dates_from_ywpc, .sale_price_dates_from_ywpc') ? 'minDate' : 'maxDate';

            var instance = $(this).data('datepicker'),
                date = $.datepicker.parseDate(
                    instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                    selectedDate, instance.settings);
            dates_ywpc.not(this).datepicker('option', option, date);

            if ($(this).is('#_sale_price_dates_from_ywpc, .sale_price_dates_from_ywpc')) {

                var now_date = new Date,
                    start_date = new Date($(this).val()),
                    checkbox = $('#_ywpc_enabled');

                if ((start_date > now_date) && !ywpc.pre_schedule) {
                    checkbox.attr('checked', false).prop('disabled', true);
                } else {
                    checkbox.prop('disabled', false);
                }

                $('#_sale_price_dates_from').val($(this).val());
                $('#_sale_price_dates_to').datepicker('option', option, date);

            } else {

                $('#_sale_price_dates_to').val($(this).val());
                $('#_sale_price_dates_from').datepicker('option', option, date);

            }

        }

    });

    /**
     * Overwriting date picker in general Tab
     */
    var dates = $('.sale_price_dates_fields input');

    dates.datepicker('destroy'); //Removing previous function

    dates.datepicker({
        defaultDate    : '',
        dateFormat     : 'yy-mm-dd',
        numberOfMonths : 1,
        showButtonPanel: true,
        onSelect       : function (selectedDate) {
            var option = $(this).is('#_sale_price_dates_from, .sale_price_dates_from') ? 'minDate' : 'maxDate';

            var instance = $(this).data('datepicker'),
                date = $.datepicker.parseDate(
                    instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                    selectedDate, instance.settings);
            dates.not(this).datepicker('option', option, date);

            if ($(this).is('#_sale_price_dates_from, .sale_price_dates_from')) {

                var now_date = new Date,
                    start_date = new Date($(this).val()),
                    checkbox = $('#_ywpc_enabled');

                if ((start_date > now_date) && !ywpc.pre_schedule) {
                    checkbox.attr('checked', false).prop('disabled', true);
                } else {
                    checkbox.prop('disabled', false);
                }

                $('#_sale_price_dates_from_ywpc').val($(this).val());
                $('#_sale_price_dates_to_ywpc').datepicker('option', option, date);

            } else {

                $('#_sale_price_dates_to_ywpc').val($(this).val());
                $('#_sale_price_dates_from_ywpc').datepicker('option', option, date);

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
