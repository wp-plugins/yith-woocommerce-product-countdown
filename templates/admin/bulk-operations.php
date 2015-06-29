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
 * Displays the bulk operations in YWPC plugin admin tab
 *
 * @class   YWPC_Bulk_Operations
 * @package Yithemes
 * @since   1.0.0
 * @author  Your Inspiration Themes
 *
 */
class YWPC_Bulk_Operations {

    /**
     * Outputs the bulk operations template in plugin options panel
     *
     * @since   1.0.0
     * @author  Alberto Ruggiero
     * @return  string
     */
    public static function output() {

        $sections        = array(
            'selection' => __( 'Assign to a selection of products', 'ywpc' ),
            'category'  => __( 'Assign to a category', 'ywpc' ),
            'recent'    => __( 'Assign to all recent products', 'ywpc' ),
            'onsale'    => __( 'Assign to all on sale products', 'ywpc' ),
            'featured'  => __( 'Assign to all featured products', 'ywpc' ),
        );
        $array_keys      = array_keys( $sections );
        $current_section = isset( $_GET['section'] ) ? $_GET['section'] : 'selection';
        $nonce           = basename( __FILE__ );
        $products_list   = array();

        if ( !empty( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], $nonce ) ) {

            $args = array();

            switch ( $current_section ) {
                case 'recent':
                    $args = array(
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1
                    );
                    break;

                case 'onsale':

                    $args = array(
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1,
                        'meta_query'     => array(
                            'relation' => 'OR',
                            array( // Simple products type
                                   'key'     => '_sale_price',
                                   'value'   => 0,
                                   'compare' => '>',
                                   'type'    => 'numeric'
                            ),
                            array( // Variable products type
                                   'key'     => '_min_variation_sale_price',
                                   'value'   => 0,
                                   'compare' => '>',
                                   'type'    => 'numeric'
                            )
                        )
                    );

                    break;

                case 'featured':

                    $args = array(
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1,
                        'meta_key'       => '_featured',
                        'meta_value'     => 'yes'
                    );

                    break;

                case 'category':

                    $category = $_POST['ywpc_categories_search'];

                    if ( !$category ) {
                        $notice = __( 'You must select a category', 'ywpc' );
                        continue;
                    }

                    $args = array(
                        'post_type'      => 'product',
                        'post_status'    => 'publish',
                        'posts_per_page' => - 1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'slug',
                                'terms'    => $category
                            ),
                        )
                    );
                    break;

                default:

                    $products = $_POST['ywpc_product_search'];

                    if ( !$products ) {
                        $notice = __( 'You must select at least one product', 'ywpc' );
                        continue;
                    }

                    $products_list = explode( ',', $products );

            }

            if ( $current_section != 'selection' ) {

                wp_reset_query();

                if ( $current_section == 'recent' ) {
                    add_filter( 'posts_where', array( __CLASS__, 'bulk_filter_where' ) );
                }

                $query = new WP_Query( $args );

                if ( $current_section == 'recent' ) {
                    remove_filter( 'posts_where', array( __CLASS__, 'bulk_filter_where' ) );
                }

                if ( $query->have_posts() ) {

                    while ( $query->have_posts() ) {

                        $query->the_post();
                        $products_list[$query->post->ID] = $query->post->ID;

                    }

                }

                wp_reset_postdata();

            }

            $ywpc_enabled = isset( $_POST['ywpc_enabled'] ) ? 'yes' : 'no';
            $start_sale   = isset( $_POST['ywpc_start_sale'] ) ? wc_clean( $_POST['ywpc_start_sale'] ) : '';
            $end_sale     = isset( $_POST['ywpc_end_sale'] ) ? wc_clean( $_POST['ywpc_end_sale'] ) : '';
            $discount_qty = isset( $_POST['ywpc_discount_qty'] ) ? $_POST['ywpc_discount_qty'] : '';
            $sold_qty     = isset( $_POST['ywpc_sold_qty'] ) ? $_POST['ywpc_sold_qty'] : '';

            foreach ( $products_list as $product_id ) {

                $product = wc_get_product( $product_id );

                if ( $product->post->post_type != 'product' ) {
                    continue;
                }

                update_post_meta( $product_id, '_ywpc_enabled', $ywpc_enabled );

                if ( $product->product_type != 'variable' ) {

                    update_post_meta( $product_id, '_sale_price_dates_from', $start_sale ? strtotime( $start_sale ) : '' );
                    update_post_meta( $product_id, '_sale_price_dates_to', $end_sale ? strtotime( $end_sale ) : '' );

                    if ( $end_sale && !$start_sale ) {
                        update_post_meta( $product_id, '_sale_price_dates_from', strtotime( 'NOW', current_time( 'timestamp' ) ) );
                    }

                    update_post_meta( $product_id, '_ywpc_sold_qty', $sold_qty ? esc_attr( $sold_qty ) : 0 );
                    update_post_meta( $product_id, '_ywpc_discount_qty', $discount_qty ? esc_attr( $discount_qty ) : 0 );

                }
                else {

                    $product_variables = $product->get_available_variations();

                    if ( count( array_filter( $product_variables ) ) > 0 ) {
                        $product_variables = array_filter( $product_variables );

                        foreach ( $product_variables as $product_variable ) {

                            update_post_meta( $product_variable['variation_id'], '_sale_price_dates_from', $start_sale ? strtotime( $start_sale ) : '' );
                            update_post_meta( $product_variable['variation_id'], '_sale_price_dates_to', $end_sale ? strtotime( $end_sale ) : '' );

                            if ( $end_sale && !$start_sale ) {
                                update_post_meta( $product_variable['variation_id'], '_sale_price_dates_from', strtotime( 'NOW', current_time( 'timestamp' ) ) );
                            }

                            update_post_meta( $product_variable['variation_id'], '_ywpc_sold_qty', $sold_qty ? esc_attr( $sold_qty ) : 0 );
                            update_post_meta( $product_variable['variation_id'], '_ywpc_discount_qty', $discount_qty ? esc_attr( $discount_qty ) : 0 );

                        }

                    }

                }

                $message = sprintf( _n( '%s product updated successfully', '%s products updated successfully', count( $products_list ), 'ywpc' ), count( $products_list ) );

            }

        }

        ?>
        <ul class="subsubsub">
            <?php

            foreach ( $sections as $id => $label ) :

                $query_args  = array(
                    'page'    => $_GET['page'],
                    'tab'     => $_GET['tab'],
                    'section' => $id
                );
                $section_url = esc_url( add_query_arg( $query_args, admin_url( 'admin.php' ) ) );
                ?>
                <li>
                    <a href="<?php echo $section_url; ?>" class="<?php echo( $current_section == $id ? 'current' : '' ); ?>">
                        <?php echo $label; ?>
                    </a>
                    <?php echo( end( $array_keys ) == $id ? '' : '|' ); ?>
                </li>
            <?php
            endforeach;
            ?>
        </ul>
        <br class="clear" />
        <?php if ( !empty( $notice ) ) : ?>
            <div id="notice" class="error below-h2">
                <p>
                    <?php echo $notice; ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if ( !empty( $message ) ) : ?>
            <div id="message" class="updated below-h2">
                <p>
                    <?php echo $message; ?>
                </p>
            </div>
        <?php endif; ?>
        <form id="plugin-fw-wc" method="POST">
            <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( $nonce ); ?>" />
            <table class="form-table">
                <tbody>
                <?php

                switch ( $current_section ) :
                    case 'recent':
                        ?>
                        <tr valign="top" class="titledesc">
                            <th scope="row">
                                <label for="ywpc_days_ago">
                                    <?php _e( 'Days passed', 'ywpc' ); ?>
                                </label>
                            </th>
                            <td class="forminp forminp-sold-qty">
                                <input type="number" class="short" name="ywpc_days_ago" id="ywpc_days_ago" value="1" placeholder="" step="any" min="1">
                        <span class="description">
                            <?php _e( 'The number of days that have passed.', 'ywpc' ); ?>
                        </span>
                            </td>
                        </tr>
                        <?php
                        break;

                    case 'onsale':
                    case 'featured':
                        break;

                    case 'category':
                        ?>
                        <tr valign="top" class="titledesc">
                            <th scope="row">
                                <label for="ywpc_categories_search">
                                    <?php _e( 'Category to assign', 'ywpc' ); ?>
                                </label>
                            </th>
                            <td class="forminp forminp-categories">
                                <input type="hidden" style="width: 50%" class="ywpc-wc-category-search" id="ywpc_categories_search" name="ywpc_categories_search" data-placeholder="<?php _e( 'Search for a category&hellip;', 'ywpc' ) ?>" data-action="ywpc_json_search_product_categories" data-multiple="false" data-selected="" value="" />
                            </td>
                        </tr>
                        <?php
                        break;

                    default:
                        ?>
                            <tr valign="top" class="titledesc">
                                <th scope="row">
                                    <label for="ywpc_product_search">
                                        <?php _e( 'Products to assign', 'ywpc' ); ?>
                                    </label>
                                </th>
                                <td class="forminp forminp-categories">
                                    <input type="hidden" style="width: 50%" class="ywpc-wc-product-search" id="ywpc_product_search" name="ywpc_product_search" data-placeholder="<?php _e( 'Search for a product&hellip;', 'ywpc' ) ?>" data-action="woocommerce_json_search_products" data-multiple="true" data-selected="" value="" />
                                </td>
                            </tr>
                        <?php
                endswitch;
                ?>
                <tr valign="top" class="titledesc">
                    <th scope="row">
                        <label for="ywpc_enabled">
                            <?php _e( 'Enable', 'ywpc' ); ?>
                        </label>
                    </th>
                    <td class="forminp forminp-enable">
                        <input id="ywpc_enabled" name="ywpc_enabled" type="checkbox" class="ywpc-enabled" checked="checked" />
                        <span class="description">
                            <?php _e( 'Enable YITH WooCommerce Product Countdown for selected products.', 'ywpc' ); ?>
                        </span>
                    </td>
                </tr>
                <tr valign="top" class="titledesc">
                    <th scope="row">
                        <label for="ywpc_start_sale">
                            <?php _e( 'Sale Dates', 'ywpc' ); ?>
                        </label>
                    </th>
                    <td class="forminp forminp-dates">
                        <input type="text" class="short" name="ywpc_start_sale" id="ywpc_start_sale" value="" placeholder="<?php _e( 'From&hellip;', 'ywpc' ) ?> YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
                        <input type="text" class="short" name="ywpc_end_sale" id="ywpc_end_sale" value="" placeholder="<?php _e( 'To&hellip;', 'ywpc' ) ?>  YYYY-MM-DD" maxlength="10" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
                    </td>
                </tr>
                <tr valign="top" class="titledesc">
                    <th scope="row">
                        <label for="ywpc_discount_qty">
                            <?php _e( 'Discounted products', 'ywpc' ); ?>
                        </label>
                    </th>
                    <td class="forminp forminp-discount-qty">
                        <input type="number" class="short" name="ywpc_discount_qty" id="ywpc_discount_qty" value="" placeholder="" step="any" min="0">
                        <span class="description">
                            <?php _e( 'The number of discounted products.', 'ywpc' ); ?>
                        </span>
                    </td>
                </tr>
                <tr valign="top" class="titledesc">
                    <th scope="row">
                        <label for="ywpc_sold_qty">
                            <?php _e( 'Already sold products', 'ywpc' ); ?>
                        </label>
                    </th>
                    <td class="forminp forminp-sold-qty">
                        <input type="number" class="short" name="ywpc_sold_qty" id="ywpc_sold_qty" value="" placeholder="" step="any" min="0">
                        <span class="description">
                            <?php _e( 'The number of already sold products.', 'ywpc' ); ?>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="submit" value="<?php _e( 'Submit', 'ywpc' ); ?>" id="submit" class="button-primary" name="submit">

        </form>
    <?php
    }

    /**
     * Get category name
     *
     * @since   1.0.0
     *
     * @param   $x
     * @param   $taxonomy_types
     *
     * @return  string
     * @author  Alberto Ruggiero
     */
    public static function json_search_product_categories( $x = '', $taxonomy_types = array( 'product_cat' ) ) {

        global $wpdb;

        $term = (string) urldecode( stripslashes( strip_tags( $_GET['term'] ) ) );
        $term = "%" . $term . "%";

        $query_cat = $wpdb->prepare( "SELECT {$wpdb->terms}.term_id,{$wpdb->terms}.name, {$wpdb->terms}.slug
                                   FROM {$wpdb->terms} INNER JOIN {$wpdb->term_taxonomy} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id
                                   WHERE {$wpdb->term_taxonomy}.taxonomy IN (%s) AND {$wpdb->terms}.slug LIKE %s", implode( ",", $taxonomy_types ), $term );

        $product_categories = $wpdb->get_results( $query_cat );

        $to_json = array();

        foreach ( $product_categories as $product_category ) {

            $to_json[$product_category->slug] = "#" . $product_category->term_id . "-" . $product_category->name;

        }

        echo json_encode( $to_json );

        die();

    }

    /**
     * Set custom where condition
     *
     * @since   1.0.0
     *
     * @param   $where
     *
     * @return  string
     * @author  Alberto Ruggiero
     */
    public static function bulk_filter_where( $where = '' ) {

        $days = isset( $_POST['ywpc_days_ago'] ) ? $_POST['ywpc_days_ago'] : '';

        $where .= " AND post_date > '" . date( 'Y-m-d', strtotime( '-' . $days . ' days' ) ) . "'";

        return $where;

    }
}