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
 * Main class
 *
 * @class   YWPC_Widget
 * @package Yithemes
 * @since   1.0.0
 * @author  Your Inspiration Themes
 */

if ( !class_exists( 'YWPC_Widget' ) ) {

    class YWPC_Widget extends WP_Widget {

        /**
         * Constructor
         *
         * @since   1.0.0
         * @return  mixed
         * @author  Alberto Ruggiero
         */
        public function __construct() {
            parent::__construct(
                'ywpc_widget', __( 'YITH WooCommerce Product Countdown', 'ywpc' ), array( 'description' => __( 'Display a list of products with sale timer and/or sale bar', 'ywpc' ), )
            );
        }

        /**
         * Outputs the content of the widget
         *
         * @since   1.0.0
         *
         * @param   $args
         * @param   $instance
         *
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function widget( $args, $instance ) {

            extract( $args );

            if ( count( $instance['product_ids'] ) > 0 ) {

                if ( $instance['title'] ) :

                    ?>

                    <h3>
                        <?php echo $instance['title']; ?>
                    </h3>

                <?php

                endif;

                $ids = explode( ',', $instance['product_ids'] );
                $ids = array_map( 'trim', $ids );

                $options = array(
                    'show_title'     => get_option( 'ywpc_widget_title', 'yes' ),
                    'show_rating'    => get_option( 'ywpc_widget_rating', 'yes' ),
                    'show_price'     => get_option( 'ywpc_widget_price', 'yes' ),
                    'show_image'     => get_option( 'ywpc_widget_image', 'yes' ),
                    'show_addtocart' => get_option( 'ywpc_widget_addtocart', 'yes' ),
                );

                YITH_WPC()->get_ywpc_custom_loop( $ids, 'widget', $options );

            }

        }

        /**
         * Outputs the options form on admin
         *
         * @since   1.0.0
         *
         * @param   $instance
         *
         * @return  void
         * @author  Alberto Ruggiero
         */
        public function form( $instance ) {
            $query_args = array(
                'post_type'   => 'product',
                'post_status' => 'publish',
                'nopaging'    => true
            );
            $posts      = new WP_Query( $query_args );

            $defaults = array( 'product_ids' => '',
                               'title'       => 'Our Exclusive Sale'
            );
            @$instance = wp_parse_args( (array) $instance, $defaults );

            $options = '';

            if ( $posts->have_posts() ) {
                while ( $posts->have_posts() ) {
                    $posts->the_post();
                    $is_selected = '';
                    if ( @in_array( $posts->post->ID, $instance['product_ids'] ) ) {
                        $is_selected = "selected='selected'";
                    }
                    $options .= '<option value="' . $posts->post->ID . '" ' . $is_selected . '>#' . $posts->post->ID . ' - ' . $posts->post->post_title . '</option>';
                }
            }
            wp_reset_postdata();

            ?>
            <p>
                <label for="<?php echo $this->get_field_name( 'title' ); ?>">
                    <?php echo __( 'Widget Title', 'ywpc' ); ?>
                </label>
                <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_name( 'product_ids' ); ?>">
                    <?php echo __( 'Products to show', 'ywpc' ); ?>
                </label>


                <input type="hidden" class="ywpc-wc-product-search" data-multiple="true" name="<?php echo $this->get_field_name( 'product_ids' ); ?>" data-placeholder="<?php _e( 'Search for a product&hellip;', 'ywpc' ); ?>" data-action="woocommerce_json_search_products" data-selected="<?php
                $product_ids = array_filter( array_map( 'absint', explode( ',', $instance['product_ids'] ) ) );
                $json_ids    = array();

                foreach ( $product_ids as $product_id ) {
                    $product = wc_get_product( $product_id );
                    if ( is_object( $product ) ) {
                        $json_ids[$product_id] = wp_kses_post( $product->get_formatted_name() );
                    }
                }

                echo esc_attr( json_encode( $json_ids ) );
                ?>" value="<?php echo implode( ',', array_keys( $json_ids ) ); ?>" />

            </p>

        <?php

        }

        /**
         * Processing widget options on save
         *
         * @since   1.0.0
         *
         * @param   $new_instance
         * @param   $old_instance
         *
         * @return  array
         * @author  Alberto Ruggiero
         */
        public function update( $new_instance, $old_instance ) {
            $instance                = $old_instance;
            $instance['product_ids'] = esc_sql( $new_instance['product_ids'] );
            $instance['title']       = sanitize_text_field( $new_instance['title'] );

            return $instance;
        }

    }

}