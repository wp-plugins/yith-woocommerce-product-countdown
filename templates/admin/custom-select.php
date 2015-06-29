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

/**
 * Implements a custom select in YWPC plugin admin tab
 *
 * @class   YWPC_Custom_Select
 * @package Yithemes
 * @since   1.0.0
 * @author  Your Inspiration Themes
 *
 */
class YWPC_Custom_Select {

    /**
     * Outputs a custom select template in plugin options panel
     *
     * @since   1.0.0
     *
     * @param   $option
     *
     * @return  void
     * @author  Alberto Ruggiero
     */
    public static function output( $option ) {

        $custom_attributes = array();

        if ( !empty( $option['custom_attributes'] ) && is_array( $option['custom_attributes'] ) ) {
            foreach ( $option['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }

        $option_value = WC_Admin_Settings::get_option( $option['id'], $option['default'] );

        if ( $option_value != '' ) {
            $product        = wc_get_product( $option_value );
            $formatted_name = wp_kses_post( $product->get_formatted_name() );
        }
        else {
            $formatted_name = '';
        }

        ?>
        <tr valign="top" class="titledesc">
            <th scope="row">
                <label for="<?php echo esc_attr( $option['id'] ); ?>"><?php echo esc_html( $option['title'] ); ?></label>
            </th>
            <td class="forminp forminp-<?php echo sanitize_title( $option['type'] ) ?>">
                <input
                    type="hidden"
                    style="<?php echo esc_attr( $option['css'] ); ?>"
                    class="<?php echo esc_attr( $option['class'] ); ?>"
                    id="<?php echo esc_attr( $option['id'] ); ?>"
                    name="<?php echo esc_attr( $option['id'] ); ?>"
                    data-placeholder="<?php _e( 'Search for a product&hellip;', 'ywpc' ) ?>"
                    data-action="woocommerce_json_search_products"
                    data-multiple="false"
                    data-selected="<?php echo $formatted_name ?>"
                    value="<?php echo $option_value; ?>"
                    <?php echo implode( ' ', $custom_attributes ); ?>/>
            </td>
        </tr>
    <?php
    }

}