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

return array(
    'general' => array(
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