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
    'style' => array(
        'ywpc_style_title'                => array(
            'name' => __( 'Customization Settings', 'ywpc' ),
            'type' => 'title',
            'desc' => '',
            'id'   => 'ywpc_style_title',
        ),
        'ywpc_style_timer_title'          => array(
            'title'   => __( 'Timer title', 'ywpc' ),
            'id'      => 'ywpc_timer_title',
            'default' => __( 'Countdown to sale', 'ywpc' ),
            'type'    => 'text',
            'desc'    => ''
        ),
        'ywpc_style_timer_title_before'   => array(
            'title'   => __( 'Timer title before sale starts', 'ywpc' ),
            'id'      => 'ywpc_timer_title_before',
            'default' => __( 'Countdown to upcoming sale', 'ywpc' ),
            'type'    => 'text',
            'desc'    => ''
        ),
        'ywpc_style_sale_bar title'       => array(
            'title'   => __( 'Sale bar title', 'ywpc' ),
            'id'      => 'ywpc_sale_bar_title',
            'default' => __( 'On sale', 'ywpc' ),
            'type'    => 'text',
            'desc'    => ''
        ),
        'ywpc_style_template'             => array(
            'name'    => __( 'Countdown and sale bar template', 'ywpc' ),
            'id'      => 'ywpc_template',
            'default' => '1',
            'type'    => 'custom-radio',
            'class'   => 'ywpc-template',
            'options' => array(
                '1' => __( 'Style 1', 'ywpc' ),
                '2' => __( 'Style 2', 'ywpc' ),
                '3' => __( 'Style 3', 'ywpc' ),
            ),
        ),

        'ywpc_style_appearance'           => array(
            'name'    => __( 'Color and font size', 'ywpc' ),
            'id'      => 'ywpc_appearance',
            'default' => 'def',
            'class'   => 'ywpc-appearance',
            'type'    => 'radio',
            'options' => array(
                'def'  => __( 'Use template default settings', 'ywpc' ),
                'cust' => __( 'Customize', 'ywpc' ),
            ),
        ),
        'ywpc_style_text_font_size'       => array(
            'name'              => __( 'Text font size', 'ywpc' ),
            'type'              => 'number',
            'desc'              => __( 'Set font size for message text. Min: 10 - Max: 55', 'ywpc' ),
            'class'             => 'ywpc-font-size',
            'default'           => 25,
            'id'                => 'ywpc_text_font_size',
            'custom_attributes' => array(
                'min'      => 10,
                'max'      => 55,
                'required' => 'required'
            )
        ),
        'ywpc_style_timer_font_size'      => array(
            'name'              => __( 'Timer font size', 'ywpc' ),
            'type'              => 'number',
            'desc'              => __( 'Set font size for timer text. Min: 10 - Max: 55', 'ywpc' ),
            'class'             => 'ywpc-font-size',
            'default'           => 28,
            'id'                => 'ywpc_timer_font_size',
            'custom_attributes' => array(
                'min'      => 10,
                'max'      => 55,
                'required' => 'required'
            )
        ),
        'ywpc_style_text_font_size_loop'  => array(
            'name'              => __( 'Text font size (category page)', 'ywpc' ),
            'type'              => 'number',
            'desc'              => __( 'Set font size for message text. Min: 10 - Max: 20', 'ywpc' ),
            'default'           => 15,
            'id'                => 'ywpc_text_font_size_loop',
            'custom_attributes' => array(
                'min'      => 10,
                'max'      => 20,
                'required' => 'required'
            )
        ),
        'ywpc_style_timer_font_size_loop' => array(
            'name'              => __( 'Timer font size (category page)', 'ywpc' ),
            'type'              => 'number',
            'desc'              => __( 'Set font size for timer text. Min: 10 - Max: 35', 'ywpc' ),
            'default'           => 15,
            'id'                => 'ywpc_timer_font_size_loop',
            'custom_attributes' => array(
                'min'      => 10,
                'max'      => 35,
                'required' => 'required'
            )
        ),
        'ywpc_style_text_color'           => array(
            'name'    => __( 'Text color', 'ywpc' ),
            'id'      => 'ywpc_text_color',
            'default' => '#a12418',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for message text.', 'ywpc' ),
        ),
        'ywpc_style_border_color'         => array(
            'name'    => __( 'Border color', 'ywpc' ),
            'id'      => 'ywpc_border_color',
            'default' => '#dbd8d8',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for box border.', 'ywpc' ),
        ),
        'ywpc_style_back_color'           => array(
            'name'    => __( 'Background color', 'ywpc' ),
            'id'      => 'ywpc_back_color',
            'default' => '#fafafa',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for box background.', 'ywpc' ),
        ),
        'ywpc_style_timer_fore_color'     => array(
            'name'    => __( 'Timer text color', 'ywpc' ),
            'id'      => 'ywpc_timer_fore_color',
            'default' => '#3c3c3c',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for timer text.', 'ywpc' ),
        ),
        'ywpc_style_timer_back_color'     => array(
            'name'    => __( 'Timer background color', 'ywpc' ),
            'id'      => 'ywpc_timer_back_color',
            'default' => '#ffffff',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for timer background.', 'ywpc' ),
        ),
        'ywpc_style_bar_fore_color'       => array(
            'name'    => __( 'Sale bar main color', 'ywpc' ),
            'id'      => 'ywpc_bar_fore_color',
            'default' => '#a12418',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for sale bar foreground.', 'ywpc' ),
        ),
        'ywpc_style_bar_back_color'       => array(
            'name'    => __( 'Sale bar background color', 'ywpc' ),
            'id'      => 'ywpc_bar_back_color',
            'default' => '#e6e6e6',
            'type'    => 'text',
            'class'   => 'colorpick',
            'desc'    => __( 'Set color for sale bar background.', 'ywpc' ),
        ),
        'ywpc_style_end'                  => array(
            'type' => 'sectionend',
            'id'   => 'ywpc_style_end'
        ),
    )
);