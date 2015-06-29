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
    'premium-general' => array(
        'ywpc_general_title'             => array(
            'name' => __( 'General Settings', 'ywpc' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_general_title',
        ),
        'ywpc_general_enable_plugin'     => array(
            'name'    => __( 'Enable YITH WooCommerce Product Countdown', 'ywpc' ),
            'type'    => 'checkbox',
            'desc'    => '',
            'id'      => 'ywpc_enable_plugin',
            'default' => 'yes',
        ),
        'ywpc_general_what_show'         => array(
            'name'    => __( 'Select type', 'ywpc' ),
            'id'      => 'ywpc_what_show',
            'default' => 'both',
            'type'    => 'radio',
            'options' => array(
                'both'  => __( 'Both timer and sale bar', 'ywpc' ),
                'timer' => __( 'Timer only ', 'ywpc' ),
                'bar'   => __( 'Sale bar only', 'ywpc' ),
            ),
        ),
        'ywpc_general_where_show'        => array(
            'name'    => __( 'Select position', 'ywpc' ),
            'id'      => 'ywpc_where_show',
            'default' => 'both',
            'type'    => 'radio',
            'options' => array(
                'both' => __( 'Categories and product detail page', 'ywpc' ),
                'loop' => __( 'Categories only', 'ywpc' ),
                'page' => __( 'Product detail page only', 'ywpc' )
            ),
        ),
        'ywpc_general_before_sale_start' => array(
            'name'    => __( 'Show timer before sale starts', 'ywpc' ),
            'type'    => 'checkbox',
            'desc'    => '',
            'id'      => 'ywpc_before_sale_start',
            'default' => 'no',
        ),
        'ywpc_general_end_sale'          => array(
            'name'    => __( 'Behaviour on expiration or sold out', 'ywpc' ),
            'id'      => 'ywpc_end_sale',
            'default' => 'hide',
            'type'    => 'radio',
            'options' => array(
                'hide'    => __( 'Hide countdown and/or sale bar', 'ywpc' ),
                'remove'  => __( 'Remove product from sale', 'ywpc' ),
                'disable' => __( 'Leave the product unavailable', 'ywpc' )
            ),
        ),
        'ywpc_general_end_sale_summary'  => array(
            'name'    => __( 'Show sale summary', 'ywpc' ),
            'type'    => 'checkbox',
            'desc'    => __( 'Only if product is unavailable', 'ywpc' ),
            'id'      => 'ywpc_end_sale_summary',
            'default' => 'no',
        ),
        'ywpc_general_end'               => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_general_end'
        ),

        'ywpc_position_start'            => array(
            'name' => __( 'Timer and sale bar position', 'ywpc' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_position_start'
        ),
        'ywpc_position_product'          => array(
            'name'    => __( 'Product Page', 'ywpc' ),
            'id'      => 'ywpc_position_product',
            'default' => '0',
            'type'    => 'select',
            'desc'    => __( 'The position where timer and sale bar are showed in product detail pages.', 'ywpc' ),
            'options' => array(
                '0' => __( 'Before title', 'ywpc' ),
                '1' => __( 'After price', 'ywpc' ),
                '2' => __( 'Before "Add to cart"', 'ywpc' ),
                '3' => __( 'Before tabs', 'ywpc' ),
                '4' => __( 'Between tabs and related products', 'ywpc' ),
                '5' => __( 'After related products', 'ywpc' )
            ),
        ),
        'ywpc_position_category'         => array(
            'name'    => __( 'Category', 'ywpc' ),
            'id'      => 'ywpc_position_category',
            'default' => '0',
            'type'    => 'select',
            'desc'    => __( 'The position where timer and sale bar are showed in category pages.', 'ywpc' ),
            'options' => array(
                '0' => __( 'Before title', 'ywpc' ),
                '1' => __( 'Before price', 'ywpc' ),
                '2' => __( 'Between price and "Add to cart"', 'ywpc' ),
                '3' => __( 'After "Add to cart"', 'ywpc' )
            ),
        ),
        'ywpc_position_end'              => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_position_end'
        ),

        'ywpc_shortcode_start'           => array(
            'name' => __( 'Shortcode settings', 'ywpc' ),
            'type' => 'title',
            'id'   => 'ywpc_shortcode_start'
        ),
        'ywpc_shortcode_title'           => array(
            'name'          => __( 'Product elements to show', 'ywpc' ),
            'type'          => 'checkbox',
            'desc'          => __( 'Title', 'ywpc' ),
            'id'            => 'ywpc_shortcode_title',
            'default'       => 'yes',
            'checkboxgroup' => 'start'
        ),
        'ywpc_shortcode_rating'          => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Rating', 'ywpc' ),
            'id'            => 'ywpc_shortcode_rating',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_shortcode_price'           => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Price', 'ywpc' ),
            'id'            => 'ywpc_shortcode_price',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_shortcode_image'           => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Image', 'ywpc' ),
            'id'            => 'ywpc_shortcode_image',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_shortcode_addtocart'       => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( '"Add to cart"', 'ywpc' ),
            'id'            => 'ywpc_shortcode_addtocart',
            'default'       => 'yes',
            'checkboxgroup' => 'end'
        ),
        'ywpc_shortcode_end'             => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_shortcode_end'
        ),

        'ywpc_widget_start'              => array(
            'name' => __( 'Widget settings', 'ywpc' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_widget_start'
        ),
        'ywpc_widget_title'              => array(
            'name'          => __( 'Product elements to show', 'ywpc' ),
            'type'          => 'checkbox',
            'desc'          => __( 'Title', 'ywpc' ),
            'id'            => 'ywpc_widget_title',
            'default'       => 'yes',
            'checkboxgroup' => 'start'
        ),
        'ywpc_widget_rating'             => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Rating', 'ywpc' ),
            'id'            => 'ywpc_widget_rating',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_widget_price'              => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Price', 'ywpc' ),
            'id'            => 'ywpc_widget_price',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_widget_image'              => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( 'Image', 'ywpc' ),
            'id'            => 'ywpc_widget_image',
            'default'       => 'yes',
            'checkboxgroup' => '',
        ),
        'ywpc_widget_addtocart'          => array(
            'name'          => '',
            'type'          => 'checkbox',
            'desc'          => __( '"Add to cart"', 'ywpc' ),
            'id'            => 'ywpc_widget_addtocart',
            'default'       => 'yes',
            'checkboxgroup' => 'end'
        ),
        'ywpc_widget_end'                => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_shortcode_end'
        ),

    )

);