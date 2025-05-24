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

?>
<div class="meta-box-sortables ui-sortable">
	<div class="postbox">
		<button type="button" class="handlediv" aria-expanded="true" data-toggle="collapse" data-target="#<?php echo esc_attr( $options['id'] ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle Panel', 'woo-products-slider-pro' ); ?></span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>
		<!-- Toggle -->

		<h2 class="hndle"><span><?php echo esc_html( $options['title'] ); ?></span></h2>

		<div class="inside collapse show" id="<?php echo esc_attr( $options['id'] ); ?>">
			<div class="woopsp_shortcode">
				<p class="float-left"><code class="slider_shortcode_code">[<?php echo esc_attr( $options['shortcode'] ); ?>]</code></p>
				<button class="button-secondary float-right" data-toggle="collapse" data-target=".form_<?php echo esc_attr( $options['id'] ); ?>"><?php esc_html_e( 'Customize Shortcode', 'woo-products-slider-pro' ); ?></button>
			</div>

			<form class="collapse customize_shortcode_form form_<?php echo esc_attr( $options['id'] ); ?>" data-shortcode="<?php echo esc_attr( $options['shortcode'] ); ?>">
				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_specific_products_filter"><?php esc_html_e( 'Show Specific Products Only', 'woo-products-slider-pro' ); ?></label>
						<select name="specific_products_filter" id="<?php echo esc_attr( $options['id'] ); ?>_specific_products_filter" class="specific_products_filter form-control" multiple="multiple"></select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_stock_status_filter"><?php esc_html_e( 'Filter By Stock Status', 'woo-products-slider-pro' ); ?></label>
						<select name="stock_status" id="<?php echo esc_attr( $options['id'] ); ?>_stock_status_filter" class="select2 stock_status_filter form-control">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $options['woo_stock_status_options'];
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_cat_filter"><?php esc_html_e( 'Filter By Category', 'woo-products-slider-pro' ); ?></label>
						<select name="cat_filter" id="<?php echo esc_attr( $options['id'] ); ?>_cat_filter" class="select2 cat_filter form-control" multiple="multiple">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $options['woo_product_category_options'];
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_tag_filter"><?php esc_html_e( 'Filter By Tag', 'woo-products-slider-pro' ); ?></label>
						<select name="tag_filter" id="<?php echo esc_attr( $options['id'] ); ?>_tag_filter" class="select2 tag_filter form-control" multiple="multiple">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $options['woo_product_tags_options'];
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_sku_filter"><?php esc_html_e( 'Filter By SKU', 'woo-products-slider-pro' ); ?></label>
						<select name="sku_filter" id="<?php echo esc_attr( $options['id'] ); ?>_sku_filter" class="select2 sku_filter form-control" multiple="multiple"></select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_attribute_filter"><?php esc_html_e( 'Filter By Attributes', 'woo-products-slider-pro' ); ?></label>
						<select name="attribute_filter" id="<?php echo esc_attr( $options['id'] ); ?>_attribute_filter" class="select2 attribute_filter form-control" multiple="multiple">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $options['woo_attributes_options'];
							?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_limit"><?php esc_html_e( 'Total Products To Query : Default All (-1)', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="limit" id="<?php echo esc_attr( $options['id'] ); ?>_limit" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show"><?php esc_html_e( 'Total Products To Show in a Slider : Default 3', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_show" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll"><?php esc_html_e( 'Total Products Slide Each Time : Default 3', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_scroll" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_mobile"><?php esc_html_e( 'Total Products To Show in a Slider For Mobile Devices ( 320px — 480px ) : Default 1', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_show_for_mobile" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_mobile" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_mobile"><?php esc_html_e( 'Total Products Slide Each Time For Mobile Devices ( 320px — 480px ) : Default 1', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_scroll_for_mobile" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_mobile" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_tablet"><?php esc_html_e( 'Total Products To Show in a Slider For iPads/Tablets Devices ( 481px — 768px ) : Default 2', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_show_for_tablet" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_tablet" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_tablet"><?php esc_html_e( 'Total Products Slide Each Time For iPads/Tablets Devices ( 481px — 768px ) : Default 2', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_scroll_for_tablet" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_tablet" class="form-control">
					</div>
					
					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_laptop"><?php esc_html_e( 'Total Products To Show in a Slider For Laptop/Small Devices ( 769px — 1024px ) : Default 3', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_show_for_laptop" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_show_for_laptop" class="form-control">
					</div>

					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_laptop"><?php esc_html_e( 'Total Products Slide Each Time For Laptop/Small Devices ( 769px — 1024px ) : Default 3', 'woo-products-slider-pro' ); ?></label>
						<input type="text" name="slide_to_scroll_for_laptop" id="<?php echo esc_attr( $options['id'] ); ?>_slide_to_scroll_for_laptop" class="form-control">
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<label for="<?php echo esc_attr( $options['id'] ); ?>_autoplay_speed">
							<?php esc_html_e( 'Slider Autoplay Speed ( Default : 3000 miliseconds ) [ Note : 1 second = 1000 milisecond ]', 'woo-products-slider-pro' ); ?>
						</label>
						<input type="text" name="autoplay_speed" class="form-control" value="" id="<?php echo esc_attr( $options['id'] ); ?>_autoplay_speed">
					</div>

					<div class="form-group col-md-4">
						<div class="form-check">
							<label class="form-check-label" for="<?php echo esc_attr( $options['id'] ); ?>_autoplay">
								<?php esc_html_e( "Don't Autoplay Slide ( Default : Yes )", 'woo-products-slider-pro' ); ?>
							</label>
							<input type="checkbox" name="autoplay" class="form-check-input" value="false" id="<?php echo esc_attr( $options['id'] ); ?>_autoplay">
						</div>
					</div>

					<div class="form-group col-md-4">
						<div class="form-check">
							<label class="form-check-label" for="<?php echo esc_attr( $options['id'] ); ?>_arrows">
								<?php esc_html_e( "Don't Show Arrows ( Default : Yes )", 'woo-products-slider-pro' ); ?>
							</label>
							<input type="checkbox" name="arrows" class="form-check-input" value="false" id="<?php echo esc_attr( $options['id'] ); ?>_arrows" >
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-4">
						<div class="form-check">
							<label class="form-check-label" for="<?php echo esc_attr( $options['id'] ); ?>_dots">
								<?php esc_html_e( "Don't Show Dots ( Default : Yes )", 'woo-products-slider-pro' ); ?>
							</label>
							<input type="checkbox" name="dots" class="form-check-input" value="false" id="<?php echo esc_attr( $options['id'] ); ?>_dots">
						</div>
					</div>

					<div class="form-group col-md-4">
						<div class="form-check">
							<label class="form-check-label" for="<?php echo esc_attr( $options['id'] ); ?>_rtl">
								<?php esc_html_e( 'Slide Right To Left ( Default : No )', 'woo-products-slider-pro' ); ?>
							</label>
							<input type="checkbox" name="rtl" class="form-check-input" value="true" id="<?php echo esc_attr( $options['id'] ); ?>_rtl">
						</div>
					</div>

					<div class="form-group col-md-4">
						<button type="button" class="button-primary generate_btn float-right">
							<?php esc_html_e( 'Generate Customized Shortcode', 'woo-products-slider-pro' ); ?>
						</button>
					</div>
				</div>
			</form>
		</div><!-- .inside -->
	</div><!-- .postbox -->
</div><!-- .meta-box-sortables .ui-sortable -->