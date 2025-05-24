<?php
/**
 * This file contains the definition of the Woo_Products_Slider_Pro_Public class, which
 * is used to load the plugin's public-facing functionality.
 *
 * @package       Woo_Products_Slider_Pro
 * @subpackage    Woo_Products_Slider_Pro/public
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version and other methods.
 *
 * @since    2.0.0
 */
class Woo_Products_Slider_Pro_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     string $plugin_name The name of the plugin.
	 * @param     string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_styles() {
		wp_register_style( $this->plugin_name, WOO_PRODUCTS_SLIDER_PRO_PLUGIN_URL . 'public/css/public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_scripts() {
		wp_register_script( $this->plugin_name, WOO_PRODUCTS_SLIDER_PRO_PLUGIN_URL . 'public/js/public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
			$this->plugin_name,
			'WooProductsSliderPro',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Captures the ID of the current product being viewed and stores it in a cookie
	 * as part of a list of recently viewed products.
	 *
	 * This method only operates on single product pages. It retrieves an existing
	 * list of product IDs from a cookie, prepends the current product's ID to it,
	 * ensures uniqueness, limits the list size, and then stores the updated list
	 * back into the cookie. The cookie is set to expire in 7 days.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    void
	 */
	public function capture_recently_viewed_products() {
		// Check if we are on a single product page.
		if ( is_product() ) {
			global $post;

			$post_id     = $post->ID;
			$cookie_name = WOO_PRODUCTS_SLIDER_PRO_PLUGIN_COOKIE_NAME;

			// Ensure we have a valid post ID (it should be a positive integer).
			if ( $post_id > 0 ) {
				$data = array(); // Initialize data as an empty array.

				// Check if the cookie exists.
				if ( isset( $_COOKIE[ $cookie_name ] ) ) {
					// 1. Unslash the data (WordPress adds slashes automatically).
					// 2. Decode the JSON string into a PHP array.
					// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					$decoded_data = json_decode( wp_unslash( $_COOKIE[ $cookie_name ] ), true );

					// Validate and sanitize the decoded data.
					// Ensure it's an array and contains only integers.
					if ( is_array( $decoded_data ) ) {
						// Filter out any non-integer values and re-index the array.
						// absint() ensures positive integers, suitable for post IDs.
						$data = array_values( array_map( 'absint', array_filter( $decoded_data, 'is_int' ) ) );
					}
					// If $decoded_data is not an array or is null, $data remains empty, which is a safe default.
				}

				// Add the current product ID to the beginning of the array.
				// absint() ensures the current post_id is also treated as a positive integer.
				array_unshift( $data, absint( $post_id ) );

				// Ensure uniqueness and limit the array to the last 10 unique products.
				// array_unique preserves keys, so array_values re-indexes it.
				$data = array_slice( array_unique( $data ), 0, 10 );

				// Set the cookie. wp_json_encode is safe for arrays and automatically handles escaping.
				// DAY_IN_SECONDS is a WordPress constant equal to 86400.
				setcookie( $cookie_name, wp_json_encode( $data ), time() + ( DAY_IN_SECONDS * 7 ), '/' );
			}
		}
	}

	/**
	 * Generates a unique sequential number.
	 *
	 * This static method uses a static variable to maintain a persistent counter
	 * across calls within the same request. Each time the method is invoked,
	 * it increments the counter and returns the new, unique integer. This is
	 * useful for generating unique IDs for HTML elements or other purposes
	 * where a simple, incrementing number is needed during a single page load.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @return    int A unique, incrementing integer.
	 */
	public static function get_unique_number() {
		static $unique = 0; // Static variable to retain its value across calls.

		// phpcs:ignore Universal.Operators.DisallowStandalonePostIncrementDecrement.PostIncrementFound
		$unique++; // Increment the unique number.

		return $unique; // Return the new unique number.
	}

	/**
	 * Determines if a slider should be rendered in Right-To-Left (RTL) mode.
	 *
	 * This method checks a provided `$rtl` parameter. If `$rtl` is empty,
	 * it then checks the global WordPress RTL setting using `is_rtl()`.
	 * If `is_rtl()` returns true, or if the `$rtl` parameter is explicitly
	 * 'true', the method returns 'true'. Otherwise, it returns 'false'.
	 * This is typically used to control the direction of a slider UI.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @param     string $rtl The desired RTL setting for the slider, often passed as a string ('true' or 'false')
	 *                        or an empty string to defer to the global WordPress setting.
	 * @return    string      true if the slider should be RTL, false otherwise.
	 */
	public static function is_slider_rtl( $rtl ) {
		// If $rtl is empty, check WordPress's global RTL setting (is_rtl()).
		// Otherwise, respect the explicit $rtl value if it's 'true'.
		return ( ( empty( $rtl ) && is_rtl() ) || 'true' === $rtl ) ? true : false;
	}

	/**
	 * Generates a WooCommerce product query arguments array based on various parameters.
	 *
	 * This function constructs an array of arguments suitable for `WP_Query` or `get_posts()`
	 * to retrieve WooCommerce products, filtering them by categories, tags, specific IDs, SKUs,
	 * and stock status.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @param     int|string   $limit        The maximum number of posts to retrieve. Use -1 for no limit.
	 * @param     array|string $cats         Comma-separated string or array of product category IDs to include.
	 * @param     array|string $tags         Comma-separated string or array of product tag IDs to include.
	 * @param     array|string $ids          Comma-separated string or array of specific product IDs to include.
	 * @param     array|string $skus         Comma-separated string or array of product SKUs to include.
	 * @param     string       $stock_status A string representing the stock status (e.g., 'instock', 'outofstock').
	 * @return    array                      The arguments array for a `WP_Query` or `get_posts()` call.
	 */
	public static function global_woo_query( $limit, $cats, $tags, $ids, $skus, $stock_status ) {
		// Setup base query arguments.
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $limit,
		);

		// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		$args['meta_query'] = array();

		// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		$args['tax_query'] = array();

		// Category Parameter: Add to tax_query if categories are provided.
		if ( ! empty( $cats ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'id',
				'terms'    => is_array( $cats ) ? $cats : explode( ',', $cats ), // Ensure terms is an array.
			);
		}

		// Tag Parameter: Add to tax_query if tags are provided.
		if ( ! empty( $tags ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_tag',
				'field'    => 'id',
				'terms'    => is_array( $tags ) ? $tags : explode( ',', $tags ), // Ensure terms is an array.
			);
		}

		// Stock Status Parameter: Add to meta_query if stock status is specified.
		if ( ! empty( $stock_status ) ) {
			$args['meta_query'][] = array(
				'key'   => '_stock_status',
				'value' => sanitize_text_field( $stock_status ), // Sanitize stock status.
			);
		}

		// SKU Parameter: Add to meta_query if SKUs are provided.
		if ( ! empty( $skus ) ) {
			$args['meta_query'][] = array(
				'key'     => '_sku',
				'compare' => 'IN',
				'value'   => is_array( $skus ) ? array_map( 'sanitize_text_field', $skus ) : array_map( 'sanitize_text_field', explode( ',', $skus ) ), // Sanitize each SKU.
			);
		}

		// ID Parameter: Use post__in for specific product IDs.
		if ( ! empty( $ids ) ) {
			$args['post__in'] = is_array( $ids ) ? array_map( 'absint', $ids ) : array_map( 'absint', explode( ',', $ids ) ); // Ensure IDs are integers.
		}

		return $args;
	}

	/**
	 * Generates and outputs the HTML for a WooCommerce product slider.
	 *
	 * This function takes an array of WP_Query arguments and slider configuration
	 * to fetch and display products within a slider structure. It leverages
	 * WooCommerce's `content-product.php` template part for individual product display.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @param     array $args        Arguments for the WP_Query to retrieve products.
	 * @param     array $slider_conf An associative array containing configuration options for the slider's JavaScript.
	 * @return    void               Outputs the HTML directly.
	 */
	public static function generate_slider_html( $args, $slider_conf ) {
		// Query database for products based on the provided arguments.
		$products = new WP_Query( $args );

		// Check if there are any products to display.
		if ( $products->have_posts() ) : ?>
			<div class="woopspro-product-slider-wrap">
				<div class="woocommerce woopspro-product-slider" id="woopspro-product-slider-<?php echo esc_attr( self::get_unique_number() ); ?>">
				<?php
				// Start the WooCommerce product loop HTML.
				woocommerce_product_loop_start();

				// Loop through each product.
				while ( $products->have_posts() ) :
					$products->the_post(); // Set up post data for the current product.

					// Include the standard WooCommerce product content template part.
					wc_get_template_part( 'content', 'product' );
				endwhile; // End of the product loop.

				// End the WooCommerce product loop HTML.
				woocommerce_product_loop_end();

				// Restore original post data.
				wp_reset_postdata();
				?>
				</div>
				<?php
					// Encode slider configuration as JSON and escape it for HTML data attribute.
					$json_slider_conf = htmlspecialchars( wp_json_encode( $slider_conf ), ENT_QUOTES, 'UTF-8' );
				?>
				<div class="woopspro-slider-conf" data-conf="<?php echo esc_attr( $json_slider_conf ); ?>"></div>
			</div>
			<?php
		endif;
	}

	/**
	 * Callback function for the plugin's shortcodes.
	 *
	 * This method processes shortcode attributes, prepares a WooCommerce product query,
	 * and generates the HTML for a product slider based on the specific shortcode tag used.
	 * It supports various product filters (categories, tags, SKUs, IDs, stock status, attributes)
	 * and slider display options (slides to show, autoplay, arrows, dots, RTL).
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     array  $atts                 The shortcode attributes.
	 * @param     string $content              The shortcode content (not used in this shortcode).
	 * @param     string $tag                  The name of the shortcode (e.g., 'woopspro_products_slider').
	 * @uses      shortcode_atts()             Combines user attributes with known defaults.
	 * @uses      self::is_slider_rtl()        Determines slider RTL status.
	 * @uses      self::global_woo_query()     Builds the base WP_Query arguments.
	 * @uses      sanitize_text_field()        Sanitizes string data.
	 * @uses      sanitize_title()             Sanitizes a string into a URL-friendly slug.
	 * @uses      sanitize_key()               Sanitizes a string to be used as a key.
	 * @uses      str_replace()                Replaces all occurrences of the search string with the replacement string.
	 * @uses      preg_match()                 Performs a regular expression match.
	 * @uses      self::generate_slider_html() Generates and outputs the slider HTML.
	 * @uses      wp_reset_postdata()          Restores original post data after custom queries.
	 * @uses      wp_json_encode()             Encodes a PHP variable into JSON.
	 * @uses      htmlspecialchars()           Converts special characters to HTML entities.
	 * @return                                 string The buffered HTML content of the product slider.
	 */
	public function shortcode_callback( $atts, $content, $tag ) {
		// Define default shortcode attributes.
		$default_atts = array(
			'cats'                       => '',
			'tags'                       => '',
			'skus'                       => '',
			'ids'                        => '',
			'tax'                        => 'product_cat',
			'stock_status'               => '',
			'limit'                      => -1,
			'slide_to_show'              => 3,
			'slide_to_show_for_mobile'   => 1,
			'slide_to_show_for_tablet'   => 2,
			'slide_to_show_for_laptop'   => 3,
			'slide_to_scroll'            => 3,
			'slide_to_scroll_for_mobile' => 1,
			'slide_to_scroll_for_tablet' => 2,
			'slide_to_scroll_for_laptop' => 3,
			'autoplay'                   => true,
			'autoplay_speed'             => 3000,
			'speed'                      => 300,
			'arrows'                     => true,
			'dots'                       => true,
			'rtl'                        => false,
			'slider_cls'                 => 'products',
			'order'                      => 'ASC',
			'orderby'                    => 'menu_order',
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- This is a shortcode attribute.
			'meta_key'                   => '',
		);

		// Merge user-provided attributes with defaults.
		$processed_atts = shortcode_atts( $default_atts, $atts );

		// Access attributes directly from $processed_atts array for better clarity and safety.
		$cats         = ( ! empty( $processed_atts['cats'] ) ) ? array_map( 'absint', explode( ',', $processed_atts['cats'] ) ) : '';
		$tags         = ( ! empty( $processed_atts['tags'] ) ) ? array_map( 'absint', explode( ',', $processed_atts['tags'] ) ) : '';
		$skus         = ( ! empty( $processed_atts['skus'] ) ) ? array_map( 'sanitize_text_field', explode( ',', $processed_atts['skus'] ) ) : '';
		$ids          = ( ! empty( $processed_atts['ids'] ) ) ? array_map( 'absint', explode( ',', $processed_atts['ids'] ) ) : '';
		$stock_status = sanitize_text_field( $processed_atts['stock_status'] );
		$limit        = intval( $processed_atts['limit'] ); // Ensure limit is an integer.
		$slider_cls   = ! empty( $processed_atts['slider_cls'] ) ? sanitize_text_field( $processed_atts['slider_cls'] ) : 'products';
		$order        = sanitize_key( $processed_atts['order'] );
		$orderby      = sanitize_key( $processed_atts['orderby'] );
		$meta_key     = sanitize_text_field( $processed_atts['meta_key'] );

		// For RTL.
		$rtl = self::is_slider_rtl( $processed_atts['rtl'] );

		wp_enqueue_style( $this->plugin_name );
		wp_enqueue_script( $this->plugin_name );

		// Slider configuration.
		$slider_conf = array(
			'slide_to_show'              => intval( $processed_atts['slide_to_show'] ),
			'slide_to_show_for_mobile'   => intval( $processed_atts['slide_to_show_for_mobile'] ),
			'slide_to_show_for_tablet'   => intval( $processed_atts['slide_to_show_for_tablet'] ),
			'slide_to_show_for_laptop'   => intval( $processed_atts['slide_to_show_for_laptop'] ),
			'slide_to_scroll'            => intval( $processed_atts['slide_to_scroll'] ),
			'slide_to_scroll_for_mobile' => intval( $processed_atts['slide_to_scroll_for_mobile'] ),
			'slide_to_scroll_for_tablet' => intval( $processed_atts['slide_to_scroll_for_tablet'] ),
			'slide_to_scroll_for_laptop' => intval( $processed_atts['slide_to_scroll_for_laptop'] ),
			'autoplay'                   => filter_var( $processed_atts['autoplay'], FILTER_VALIDATE_BOOLEAN ),
			'autoplay_speed'             => intval( $processed_atts['autoplay_speed'] ),
			'speed'                      => intval( $processed_atts['speed'] ),
			'arrows'                     => filter_var( $processed_atts['arrows'], FILTER_VALIDATE_BOOLEAN ),
			'dots'                       => filter_var( $processed_atts['dots'], FILTER_VALIDATE_BOOLEAN ),
			'rtl'                        => $rtl, // Use the sanitized $rtl variable.
			'slider_cls'                 => $slider_cls, // Use the sanitized $slider_cls variable.
		);

		ob_start();

		// Setup base query using woopspro_global_woo_query.
		$args = self::global_woo_query( $limit, $cats, $tags, $ids, $skus, $stock_status );

		// Process dynamic attribute filters (e.g., attribute_color="red,blue").
		if ( $atts ) { // Use original $atts here to check for attribute_* keys.
			foreach ( $atts as $key => $att ) {
				if ( preg_match( '/^attribute_.+$/', $key ) ) {
					$attr_name = sanitize_title( str_replace( 'attribute_', '', $key ) ); // Sanitize attribute name.

					$attr_values = ( ! empty( $att ) ) ? array_map( 'sanitize_text_field', explode( ',', $att ) ) : '';

					if ( ! empty( $attr_values ) ) {
						// Ensure tax_query exists and is an array.
						if ( ! isset( $args['tax_query'] ) || ! is_array( $args['tax_query'] ) ) {
							// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
							$args['tax_query'] = array();
						}

						$args['tax_query'][] = array(
							'taxonomy' => 'pa_' . $attr_name,
							'field'    => 'slug',
							'terms'    => $attr_values,
							'operator' => 'IN',
						);
					}
				}
			}
		}

		// Apply order and orderby parameters.
		$args['order']   = $order;
		$args['orderby'] = $orderby;

		if ( ! empty( $meta_key ) ) {
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$args['meta_key'] = $meta_key;
		}

		// Adjust query arguments based on the specific shortcode tag.
		switch ( $tag ) {
			case 'woopspro_products_slider':
				// If there are existing meta queries, ensure they are nested correctly for the default slider.
				// This handles cases where other filters might have added meta_query before this switch.
				if ( ! empty( $args['meta_query'] ) ) {
					// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
					$args['meta_query'] = array( $args['meta_query'] );
				}

				break;

			case 'woopspro_bestselling_products_slider':
				$args['orderby'] = 'meta_value_num';
				$args['order']   = 'DESC';

				unset( $args['meta_key'] ); // Best-selling doesn't typically use a custom meta_key for orderby.

				// Add meta query for best-selling products (total_sales > 0).
				$existing_meta_query = ! empty( $args['meta_query'] ) ? $args['meta_query'] : array();

				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				$args['meta_query'] = array_filter(
					array(
						array(
							'key'     => 'total_sales',
							'value'   => 0,
							'compare' => '>',
						),
						$existing_meta_query,
					)
				);

				break;

			case 'woopspro_featured_products_slider':
				// Add taxonomy query for featured products.
				$existing_tax_query = ! empty( $args['tax_query'] ) ? $args['tax_query'] : array();

				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				$args['tax_query'] = array_filter(
					array(
						array(
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',
						),
						$existing_tax_query,
					)
				);

				break;

			case 'woopspro_on_sale_products_slider':
				// Add meta query for products on sale.
				$existing_meta_query = ! empty( $args['meta_query'] ) ? $args['meta_query'] : array();

				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				$args['meta_query'] = array_filter(
					array(
						array(
							'relation' => 'OR', // Products are on sale if simple price > 0 OR variable min price > 0.
							array(
								'key'     => '_sale_price',
								'value'   => 0,
								'compare' => '>',
								'type'    => 'numeric',
							),
							array(
								'key'     => '_min_variation_sale_price',
								'value'   => 0,
								'compare' => '>',
								'type'    => 'numeric',
							),
						),
						$existing_meta_query,
					)
				);

				break;

			case 'woopspro_top_rated_products_slider':
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				$args['meta_key'] = '_wc_average_rating';
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'DESC';

				break;

			case 'woopspro_recently_viewed_products':
				$cookie_name = WOO_PRODUCTS_SLIDER_PRO_PLUGIN_COOKIE_NAME;
				$post_ids_in = array( 0 );

				// Check if the cookie exists.
				if ( isset( $_COOKIE[ $cookie_name ] ) ) {
					// 1. Unslash the data (WordPress adds slashes automatically).
					// 2. Decode the JSON string into a PHP array.
					// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
					$decoded_data = json_decode( wp_unslash( $_COOKIE[ $cookie_name ] ), true );

					// Validate and sanitize the decoded data.
					// Ensure it's an array and contains only integers.
					if ( is_array( $decoded_data ) ) {
						// Filter out any non-integer values and re-index the array.
						// absint() ensures positive integers, suitable for post IDs.
						$post_ids_in = array_values( array_map( 'absint', array_filter( $decoded_data, 'is_int' ) ) );
					}
					// If $decoded_data is not an array or is null, $data remains empty, which is a safe default.
				}

				$args['post__in'] = $post_ids_in;
				$args['orderby']  = 'post__in';

				unset( $args['order'] );
				unset( $args['meta_key'] );

				break;
		}

		// Clean up empty tax_query or meta_query to prevent WP_Query errors.
		if ( isset( $args['meta_query'] ) && empty( $args['meta_query'] ) ) {
			unset( $args['meta_query'] );
		}

		if ( isset( $args['tax_query'] ) && empty( $args['tax_query'] ) ) {
			unset( $args['tax_query'] );
		}

		self::generate_slider_html( $args, $slider_conf );

		wp_reset_postdata();

		return ob_get_clean();
	}
}
