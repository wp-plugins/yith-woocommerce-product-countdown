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

if ( empty( $args['items'] ) ) {
    return;
}

$extra_class = ( $args['class'] ) ? $args['class'] . '-' : '';

foreach ( $args['items'] as $id => $item ) {

    if ( empty( $item['end_date'] ) ) {

        continue;

    }

    if ( isset( $args['active_var'] ) && $args['active_var'] != $id ) {

        continue;

    }

    $date = ywpc_get_countdown( $item['end_date'] );

    ?>
    <div class="ywpc-countdown-loop ywpc-item-<?php echo $extra_class . $id; ?>">
        <div class="ywpc-header">
            <?php

            echo apply_filters( 'ywpc_timer_title', __( 'Countdown to sale', 'ywpc' ), $item['before'] );

            ?>
        </div>
        <div class="ywpc-timer">
            <div class="ywpc-days">
                <div class="ywpc-amount">
                    <span class="ywpc-char-1"><?php echo substr( $date['dd'], 0, 1 ); ?></span>
                    <span class="ywpc-char-2"><?php echo substr( $date['dd'], 1, 1 ); ?></span>
                </div>
                <div class="ywpc-label">
                    <?php _e( 'Days', 'ywpc' ) ?>
                </div>
            </div>
            <div class="ywpc-hours">
                <div class="ywpc-amount">
                    <span class="ywpc-char-1"><?php echo substr( $date['hh'], 0, 1 ); ?></span>
                    <span class="ywpc-char-2"><?php echo substr( $date['hh'], 1, 1 ); ?></span>
                </div>
                <div class="ywpc-label">
                    <?php _e( 'Hours', 'ywpc' ) ?>
                </div>
            </div>
            <div class="ywpc-minutes">
                <div class="ywpc-amount">
                    <span class="ywpc-char-1"><?php echo substr( $date['mm'], 0, 1 ); ?></span>
                    <span class="ywpc-char-2"><?php echo substr( $date['mm'], 1, 1 ); ?></span>
                </div>
                <div class="ywpc-label">
                    <?php _e( 'Minutes', 'ywpc' ) ?>
                </div>
            </div>
            <div class="ywpc-seconds">
                <div class="ywpc-amount">
                    <span class="ywpc-char-1"><?php echo substr( $date['ss'], 0, 1 ); ?></span>
                    <span class="ywpc-char-2"><?php echo substr( $date['ss'], 1, 1 ); ?></span>
                </div>
                <div class="ywpc-label">
                    <?php _e( 'Seconds', 'ywpc' ) ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var countdown_div = $('.ywpc-item-<?php echo $extra_class . $id;?> .ywpc-timer'),
                countdown_html = countdown_div.clone(),
                first_char = ' .ywpc-amount .ywpc-char-1',
                second_char = ' .ywpc-amount .ywpc-char-2';

            $('.ywpc-days' + first_char, countdown_html).text('{d10}');
            $('.ywpc-days' + second_char, countdown_html).text('{d1}');

            $('.ywpc-hours' + first_char, countdown_html).text('{h10}');
            $('.ywpc-hours' + second_char, countdown_html).text('{h1}');

            $('.ywpc-minutes' + first_char, countdown_html).text('{m10}');
            $('.ywpc-minutes' + second_char, countdown_html).text('{m1}');

            $('.ywpc-seconds' + first_char, countdown_html).text('{s10}');
            $('.ywpc-seconds' + second_char, countdown_html).text('{s1}');

            countdown_div.countdown({
                until : $.countdown.UTCDate(<?php echo $date['gmt']; ?>, <?php echo date( 'Y', $date['to'] ); ?>, <?php echo ( date( 'm', $date['to'] ) - 1 ); ?>, <?php echo date( 'd', $date['to'] ); ?>),
                layout: countdown_html.html()
            });

        });
    </script>
<?php
}





