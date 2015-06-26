<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

?>
<div id="<?php echo YITH_WPC()->_product_tab; ?>_tab" class="panel woocommerce_options_panel">
    <div class="options_group sales_countdown">
        <?php

        $args = array(
            'id'            => '_ywpc_enabled',
            'wrapper_class' => '',
            'label'         => __( 'Enable ', 'ywpc' ),
            'description'   => __( 'Enable YITH WooCommerce Product Countdown for this product', 'ywpc' )
        );

        woocommerce_wp_checkbox( $args );

        $sale_price_dates_from = ( $date = get_post_meta( $thepostid, '_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
        $sale_price_dates_to   = ( $date = get_post_meta( $thepostid, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

        apply_filters( 'ywpc_countdown_tab_notice', '');

        ?>
        <p class="form-field sales_countdown_dates_fields">
            <label for="_sale_price_dates_from"><?php _e( 'Sale Dates', 'ywpc' ) ?></label>
            <input type="text" class="short" name="_sale_price_dates_from_ywpc" id="_sale_price_dates_from_ywpc" value="<?php echo esc_attr( $sale_price_dates_from ) ?>" placeholder="<?php _e( 'From&hellip;', 'ywpc' ) ?> YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
            <input type="text" class="short" name="_sale_price_dates_to_ywpc" id="_sale_price_dates_to_ywpc" value="<?php echo esc_attr( $sale_price_dates_to ) ?>" placeholder="<?php _e( 'To&hellip;', 'ywpc' ) ?>  YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
            <img class="help_tip" style="margin-top: 21px;" data-tip="<?php _e( 'The sale will end at the beginning of the set date.', 'ywpc' ) ?>" src="<?php echo esc_url( WC()->plugin_url() ) ?>/assets/images/help.png" height="16" width="16" />
        </p>

        <?php

        apply_filters( 'ywpc_countdown_tab_options', '');

        ?>
    </div>
</div>
