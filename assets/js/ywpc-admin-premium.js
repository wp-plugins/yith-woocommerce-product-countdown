function ywpc_resize_thickbox() {
    var myWidth = 400,
        myHeight = 350;


    var tbWindow = jQuery('#TB_window'),
        tbFrame = jQuery('#TB_iframeContent'),
        wpadminbar = jQuery('#wpadminbar'),
        width = jQuery(window).width(),
        height = jQuery(window).height(),

        adminbar_height = 0;

    if (wpadminbar.length) {
        adminbar_height = parseInt(wpadminbar.css('height'), 10);
    }

    var TB_newWidth = ( width < (myWidth + 50)) ? ( width - 50) : myWidth;
    var TB_newHeight = ( height < (myHeight + 45 + adminbar_height)) ? ( height - 45 - adminbar_height) : myHeight;

    tbWindow.css({
        'marginLeft': -(TB_newWidth / 2),
        'marginTop' : -(TB_newHeight / 2),
        'top'       : '50%',
        'width'     : TB_newWidth,
        'height'    : TB_newHeight
    });

    tbFrame.css({
        'padding': '10px',
        'width'  : TB_newWidth - 20,
        'height' : TB_newHeight - 50
    });
}

jQuery(function ($) {

    var getEnhancedSelectFormatString = function () {
        var formatString = {
            formatMatches        : function (matches) {
                if (1 === matches) {
                    return wc_enhanced_select_params.i18n_matches_1;
                }

                return wc_enhanced_select_params.i18n_matches_n.replace('%qty%', matches);
            },
            formatNoMatches      : function () {
                return wc_enhanced_select_params.i18n_no_matches;
            },
            formatAjaxError      : function (jqXHR, textStatus, errorThrown) {
                return wc_enhanced_select_params.i18n_ajax_error;
            },
            formatInputTooShort  : function (input, min) {
                var number = min - input.length;

                if (1 === number) {
                    return wc_enhanced_select_params.i18n_input_too_short_1;
                }

                return wc_enhanced_select_params.i18n_input_too_short_n.replace('%qty%', number);
            },
            formatInputTooLong   : function (input, max) {
                var number = input.length - max;

                if (1 === number) {
                    return wc_enhanced_select_params.i18n_input_too_long_1;
                }

                return wc_enhanced_select_params.i18n_input_too_long_n.replace('%qty%', number);
            },
            formatSelectionTooBig: function (limit) {
                if (1 === limit) {
                    return wc_enhanced_select_params.i18n_selection_too_long_1;
                }

                return wc_enhanced_select_params.i18n_selection_too_long_n.replace('%qty%', limit);
            },
            formatLoadMore       : function (pageNumber) {
                return wc_enhanced_select_params.i18n_load_more;
            },
            formatSearching      : function () {
                return wc_enhanced_select_params.i18n_searching;
            }
        };

        return formatString;
    };

    var loadEnhancedSelect = function () {
        $(':input.ywpc-wc-product-search, :input.ywpc-wc-category-search').filter(':not(.enhanced)').each(function () {
            loadSelect2($(this));
        });
    };

    function loadSelect2(widget) {
        var select2_args = {
            allowClear        : widget.data('allow_clear') ? true : false,
            placeholder       : widget.data('placeholder'),
            minimumInputLength: widget.data('minimum_input_length') ? $(this).data('minimum_input_length') : '3',
            escapeMarkup      : function (m) {
                return m;
            },
            ajax              : {
                url        : wc_enhanced_select_params.ajax_url,
                dataType   : 'json',
                quietMillis: 250,
                data       : function (term, page) {
                    return {
                        term    : term,
                        action  : widget.data('action') || 'woocommerce_json_search_products_and_variations',
                        security: wc_enhanced_select_params.search_products_nonce
                    };
                },
                results    : function (data, page) {
                    var terms = [];
                    if (data) {
                        $.each(data, function (id, text) {
                            terms.push({id: id, text: text});
                        });
                    }
                    return {results: terms};
                },
                cache      : true
            }
        };

        if (widget.data('multiple') === true) {
            select2_args.multiple = true;
            select2_args.initSelection = function (element, callback) {
                var data = $.parseJSON(element.attr('data-selected'));
                var selected = [];

                $(element.val().split(',')).each(function (i, val) {
                    selected.push({id: val, text: data[val]});
                });
                return callback(selected);
            };
            select2_args.formatSelection = function (data) {
                return '<div class="selected-option" data-id="' + data.id + '">' + data.text + '</div>';
            };
        } else {
            select2_args.multiple = false;
            select2_args.initSelection = function (element, callback) {
                var data = {id: element.val(), text: element.attr('data-selected')};
                return callback(data);
            };
        }

        select2_args = $.extend(select2_args, getEnhancedSelectFormatString());

        widget.select2(select2_args).addClass('enhanced');
    }

    $('body').on('ywpc-wc-enhanced-select-init', function () {

        loadEnhancedSelect();

    }).trigger('ywpc-wc-enhanced-select-init');

    $(document).on('widget-updated', function (e, widget) {

        loadEnhancedSelect();

    });

    $(document).on('widget-added', function (e, widget) {

        var input_hidden = widget.find('input.ywpc-wc-product-search');
        input_hidden.removeClass('enhanced');

        var select2container = widget.find('div.select2-container');
        select2container.remove();

        if (input_hidden.length > 0) {

            input_hidden.each(function () {
                loadSelect2($(this));
            });


        }

    });

    var dates = $('#ywpc_start_sale, #ywpc_end_sale');

    dates.datepicker({
        defaultDate    : '',
        dateFormat     : 'yy-mm-dd',
        numberOfMonths : 1,
        showButtonPanel: true,
        onSelect       : function (selectedDate) {
            var option = $(this).is('#ywpc_start_sale') ? 'minDate' : 'maxDate';

            var instance = $(this).data('datepicker'),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);

            dates.not(this).datepicker('option', option, date);

        }

    });

    $(document).ready(function () {

        $("#ywpc_enabled").on('change', function () {

            if ($(this).is(':checked')) {

                $('#ywpc_start_sale').removeAttr('disabled');
                $('#ywpc_end_sale').removeAttr('disabled');
                $('#ywpc_discount_qty').removeAttr('disabled');
                $('#ywpc_sold_qty').removeAttr('disabled');

            } else {

                $('#ywpc_start_sale').attr('disabled', 'disabled').val('');
                $('#ywpc_end_sale').attr('disabled', 'disabled').val('');
                $('#ywpc_discount_qty').attr('disabled', 'disabled').val('');
                $('#ywpc_sold_qty').attr('disabled', 'disabled').val('');

            }

        });

    });

    $(window).resize(function () {
        ywpc_resize_thickbox();
    });

});
