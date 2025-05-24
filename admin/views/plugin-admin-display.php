<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since         2.0.0
 * @package       Woo_Products_Slider_Pro
 * @subpackage    Woo_Products_Slider_Pro/admin/views
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$woo_stock_status_options     = Woo_Products_Slider_Pro_Admin::get_woo_stock_status_options();
$woo_product_category_options = Woo_Products_Slider_Pro_Admin::get_woo_product_category_options();
$woo_product_tags_options     = Woo_Products_Slider_Pro_Admin::get_woo_product_tags_options();
$woo_attributes_options       = Woo_Products_Slider_Pro_Admin::get_woo_attributes_options();

?>
<div class="wrap">
	<h2><?php esc_html_e( 'Woocommerce Products Slider Shortcodes', 'woo-products-slider-pro' ); ?></h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- main content -->
			<div id="post-body-content">
			<?php
				Woo_Products_Slider_Pro_Admin::include_template(
					'shortcode-column',
					array(
						'id'                           => 'all_products',
						'title'                        => __( 'All Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_products_slider',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);

				Woo_Products_Slider_Pro_Admin::include_template(
					'shortcode-column',
					array(
						'id'                           => 'bestselling_products',
						'title'                        => __( 'Best Selling Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_bestselling_products_slider',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);

				Woo_Products_Slider_Pro_Admin::include_template(
					'shortcode-column',
					array(
						'id'                           => 'featured_products',
						'title'                        => __( 'Featured Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_featured_products_slider',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);

				Woo_Products_Slider_Pro_Admin::include_template(
					'shortcode-column',
					array(
						'id'                           => 'on_sale_products',
						'title'                        => __( 'ON Sale Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_on_sale_products_slider',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);

				Woo_Products_Slider_Pro_Admin::include_template(
					'shortcode-column',
					array(
						'id'                           => 'top_rated_products',
						'title'                        => __( 'Top Rated Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_top_rated_products_slider',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);

				Woo_Products_Slider_Pro_Admin::include_template(
					'recently-viewed',
					array(
						'id'                           => 'recently_viewed_products',
						'title'                        => __( 'Recently Viewed Products Slider Shortcode', 'woo-products-slider-pro' ),
						'shortcode'                    => 'woopspro_recently_viewed_products',
						'woo_stock_status_options'     => $woo_stock_status_options,
						'woo_product_category_options' => $woo_product_category_options,
						'woo_product_tags_options'     => $woo_product_tags_options,
						'woo_attributes_options'       => $woo_attributes_options,
					)
				);
				?>
			</div><!-- post-body-content -->
		</div><!-- #post-body .metabox-holder .columns-2 -->
		<br class="clear">	
	</div><!-- #poststuff -->
	<?php wp_nonce_field( 'woopspro_nonce', 'woopspro_nonce' ); ?>
</div>