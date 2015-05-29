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

$videobox = defined( 'YWPC_PREMIUM' ) ? '' : array(
    'name'    => __( 'Upgrade to the PREMIUM VERSION', 'ywpc' ),
    'type'    => 'videobox',
    'default' => array(
        'plugin_name'               => __( 'YITH WooCommerce Product Countdown', 'ywpc' ),
        'title_first_column'        => __( 'Discover the Advanced Features', 'ywpc' ),
        'description_first_column'  => __( 'Upgrade to the PREMIUM VERSION of YITH WooCommerce Product Countdown to benefit from all features!', 'ywpc' ),
        'video'                     => array(
            'video_id'          => '118792418',
            'video_image_url'   => YWPC_ASSETS_URL . '/images/yith-woocommerce-product-countdown.jpg',
            'video_description' => __( 'YITH WooCommerce Product Countdown', 'ywpc' ),
        ),
        'title_second_column'       => __( 'Get Support and Pro Features', 'ywpc' ),
        'description_second_column' => __( 'By purchasing the premium version of the plugin, you will take advantage of the advanced features of the product and you will get one year of free updates and support through our platform available 24h/24.', 'ywpc' ),
        'button'                    => array(
            'href'  => YITH_WPC()->get_premium_landing_uri(),
            'title' => 'Get Support and Pro Features'
        )
    ),
    'id'      => 'ywpc_general_videobox'
);


return array(
    'general' => array(
        //'ywpc_videobox'              => $videobox,
        'ywpc_general_title'         => array(
            'name' => __( 'General Settings', 'ywpc' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_general_title',
        ),
        'ywpc_general_enable_plugin' => array(
            'name'    => __( 'Enable YITH WooCommerce Product Countdown', 'ywpc' ),
            'type'    => 'checkbox',
            'desc'    => '',
            'id'      => 'ywpc_enable_plugin',
            'default' => 'yes',
        ),
        'ywpc_general_end'           => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_general_end'
        ),
    )

);