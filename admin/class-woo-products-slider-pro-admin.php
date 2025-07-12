<?php
/**
 * This file contains the definition of the Woo_Products_Slider_Pro_Admin class, which
 * is used to load the plugin's admin-specific functionality.
 *
 * @package       Woo_Products_Slider_Pro
 * @subpackage    Woo_Products_Slider_Pro/admin
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version and other methods.
 *
 * @since    2.0.0
 */
class Woo_Products_Slider_Pro_Admin {
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
	 * @param     string $plugin_name The name of this plugin.
	 * @param     string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_styles() {
		$current_screen = get_current_screen();

		// check if current page is plugin settings page.
		if ( 'toplevel_page_woo-products-slider-pro' === $current_screen->id ) {
			wp_enqueue_style( $this->plugin_name, WOO_PRODUCTS_SLIDER_PRO_PLUGIN_URL . 'admin/css/admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_scripts() {
		$current_screen = get_current_screen();

		// check if current page is plugin settings page.
		if ( 'toplevel_page_woo-products-slider-pro' === $current_screen->id ) {
			wp_enqueue_script( $this->plugin_name, WOO_PRODUCTS_SLIDER_PRO_PLUGIN_URL . 'admin/js/admin.js', array( 'jquery' ), $this->version, true );

			wp_localize_script(
				$this->plugin_name,
				'WooProductsSliderPro',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
				)
			);
		}
	}

	/**
	 * Adds a settings link to the plugin's action links on the plugin list table.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     array $links The existing array of plugin action links.
	 * @return    array $links The updated array of plugin action links, including the settings link.
	 */
	public function add_plugin_action_links( $links ) {
		$links[] = sprintf( '<a href="%s">%s</a>', esc_url( admin_url( 'admin.php?page=woo-products-slider-pro' ) ), __( 'Settings', 'woo-products-slider-pro' ) );

		return $links;
	}

	/**
	 * Adds the plugin settings page to the WordPress dashboard menu.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Products Slider Pro', 'woo-products-slider-pro' ),
			__( 'Products Slider', 'woo-products-slider-pro' ),
			'manage_options',
			'woo-products-slider-pro',
			array( $this, 'menu_page' ),
			'dashicons-slides'
		);
	}

	/**
	 * Renders the plugin menu page content.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function menu_page() {
		include WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . '/admin/views/plugin-admin-display.php';
	}

	/**
	 * Displays admin notices in the admin area.
	 *
	 * This function checks if the required plugin is active.
	 * If not, it displays a warning notice and deactivates the current plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function admin_notices() {
		// Check if required plugin is active.
		if ( ! class_exists( 'WooCommerce', false ) ) {
			sprintf(
				'<div class="notice notice-warning is-dismissible"><p>%s <a href="%s">%s</a> %s</p></div>',
				__( 'Free Woocommerce Products Slider-Carousel Pro requires', 'woo-products-slider-pro' ),
				esc_url( 'https://wordpress.org/plugins/woocommerce/' ),
				__( 'WooCommerce', 'woo-products-slider-pro' ),
				__( 'plugin to be active!', 'woo-products-slider-pro' ),
			);

			// Deactivate the plugin.
			deactivate_plugins( WOO_PRODUCTS_SLIDER_PRO_PLUGIN_BASENAME );
		}
	}

	/**
	 * Retrieves and formats WooCommerce product options for use in a select/search field,
	 * typically for an AJAX-powered dropdown.
	 *
	 * This method searches for WooCommerce products based on a 'search' query parameter
	 * provided in the request. It then formats the results into an array suitable
	 * for JavaScript libraries (like Select2) that expect 'id' and 'text' properties.
	 * The results are sent as a JSON success response.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @uses      sanitize_text_field()  Sanitizes string data.
	 * @uses      wp_unslash()           Removes slashes added by WordPress.
	 * @uses      get_posts()            Retrieves posts based on specified arguments.
	 * @uses      wp_send_json_success() Sends a JSON success response and exits.
	 * @return    void                   Sends a JSON response and exits.
	 */
	public function get_woo_products_options() {
		// Verify the AJAX nonce for security.
		check_ajax_referer( 'woopspro_nonce', 'woopspro_nonce' );

		$search  = isset( $_REQUEST['search'] ) && ! empty( $_REQUEST['search'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['search'] ) ) : '';
		$results = array( 'results' => array() );

		if ( ! empty( $search ) ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => -1, // Retrieve all matching products.
				's'              => $search, // Search query.
			);

			$wc_products_array = get_posts( $args );

			foreach ( $wc_products_array as $product ) {
				$results['results'][] = array(
					'id'   => $product->ID,
					'text' => $product->post_title,
				);
			}
		}

		// Send the results as a JSON success response.
		wp_send_json_success( $results );
	}

	/**
	 * Retrieves and formats WooCommerce product SKUs for use in a select/search field,
	 * typically for an AJAX-powered dropdown.
	 *
	 * This method searches for WooCommerce products based on a 'search' query parameter
	 * provided in the request. It then retrieves the SKU for each matching product
	 * and formats the results into an array suitable for JavaScript libraries (like Select2)
	 * that expect 'id' and 'text' properties. The results are sent as a JSON success response.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @uses      sanitize_text_field()  Sanitizes string data.
	 * @uses      wp_unslash()           Removes slashes added by WordPress.
	 * @uses      get_posts()            Retrieves posts based on specified arguments.
	 * @uses      get_post_meta()        Retrieves a post meta field.
	 * @uses      wp_send_json_success() Sends a JSON success response and exits.
	 * @return    void                   Sends a JSON response and exits.
	 */
	public function get_woo_skus_options() {
		// Verify the AJAX nonce for security.
		check_ajax_referer( 'woopspro_nonce', 'woopspro_nonce' );

		$search  = isset( $_REQUEST['search'] ) && ! empty( $_REQUEST['search'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['search'] ) ) : '';
		$results = array( 'results' => array() );

		if ( ! empty( $search ) ) {
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => -1, // Retrieve all matching products.
				's'              => $search, // Search query.
			);

			$wc_products_array = get_posts( $args );

			foreach ( $wc_products_array as $product ) {
				$product_sku = get_post_meta( $product->ID, '_sku', true );

				// Only add if SKU exists and is not empty.
				if ( ! empty( $product_sku ) ) {
					$results['results'][] = array(
						'id'   => $product_sku,
						'text' => $product_sku,
					);
				}
			}
		}

		// Send the results as a JSON success response.
		wp_send_json_success( $results );
	}

	/**
	 * Retrieves and outputs HTML for product attribute terms based on selected attributes.
	 *
	 * This AJAX-enabled method expects a nonce for security and an array of
	 * attribute names via `$_POST['attributes']`. For each provided attribute,
	 * it fetches its associated terms (e.g., 'red', 'blue' for 'color' attribute)
	 * and generates a `<select>` HTML element populated with these terms.
	 * The output is suitable for dynamic population of dropdowns in the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @uses      check_ajax_referer()  Verifies the AJAX nonce for security.
	 * @uses      map_deep()            Applies a callback function to all elements of an array recursively.
	 * @uses      wp_unslash()          Removes slashes added by WordPress to input data.
	 * @uses      sanitize_text_field() Sanitizes string data.
	 * @uses      get_terms()           Retrieves terms from a taxonomy.
	 * @uses      esc_attr()            Escapes data for use in an HTML attribute.
	 * @uses      esc_html()            Escapes HTML entities for display.
	 * @uses      __()                  Retrieves translated string.
	 * @return    void                  Outputs HTML directly and then calls `die()`.
	 */
	public function get_product_attributes_terms() {
		// Verify the AJAX nonce for security.
		check_ajax_referer( 'woopspro_nonce', 'woopspro_nonce' );

		$attributes = array();

		// Check if 'attributes' data is posted and sanitize it.
		if ( ! empty( $_POST['attributes'] ) ) {
			// map_deep applies sanitize_text_field to every element in the array recursively.
			$posted_data = map_deep( wp_unslash( $_POST['attributes'] ), 'sanitize_text_field' );

			// Re-index to ensure it's a simple array of attribute slugs.
			$attributes = array_values( $posted_data );
		}

		// If attributes are provided, retrieve and display their terms.
		if ( $attributes ) {
			foreach ( $attributes as $att ) {
				// Get terms for the specific product attribute taxonomy (e.g., 'pa_color').
				$terms = get_terms( 'pa_' . $att );

				if ( $terms && ! is_wp_error( $terms ) ) { // Ensure terms are found and not an error.
					?>
						<div class="row attribute_terms">
							<div class="form-group col-md-12">
								<label for="<?php echo esc_attr( $att ); ?>_attribute_term_filter">
									<?php
									// Translators: %s is the capitalized attribute name (e.g., 'Color').
									echo esc_html( sprintf( __( 'Filter By %s Attribute', 'woo-products-slider-pro' ), ucfirst( $att ) ) );
									?>
								</label>
								<select name="<?php echo esc_attr( $att ); ?>_attribute_term_filter" id="<?php echo esc_attr( $att ); ?>_attribute_term_filter" class="select2 attribute_term_filter form-control" multiple="multiple">
								<?php
								foreach ( $terms as $term ) {
									// Output each term as an option.
									echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
								}
								?>
								</select>
							</div>
						</div>
					<?php
				}
			}
		}

		// Always die at the end of an AJAX call to prevent WordPress from outputting extra data.
		die();
	}

	/**
	 * Declares compatibility with WooCommerce's custom order tables feature.
	 *
	 * This function is hooked into the `before_woocommerce_init` action and checks
	 * if the `FeaturesUtil` class exists in the `Automattic\WooCommerce\Utilities`
	 * namespace. If it does, it declares compatibility with the 'custom_order_tables'
	 * feature. This is important for ensuring the plugin works correctly with
	 * WooCommerce versions that support this feature.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function declare_compatibility_with_wc_custom_order_tables() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}

	/**
	 * Includes a template file from the plugin's admin views directory.
	 *
	 * This static method provides a structured way to include administrative
	 * view files, making `options` array available within the included template.
	 * This is typically used for rendering settings pages, meta boxes, or other
	 * UI components in the WordPress admin area.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @param     string $name    The name of the template file (e.g., 'settings-page', 'meta-box').
	 *                            The file is expected to be located at `WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH/admin/views/{$name}.php`.
	 * @param     array  $options An associative array of data to be passed to the template.
	 *                            These options can then be accessed as `$options['key']` within the included file.
	 */
	public static function include_template( $name, $options ) {
		if ( ! is_array( $options ) ) {
			$options = array();
		}

		include WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . "/admin/views/$name.php";
	}

	/**
	 * Generates HTML for product stock status options to be used in a select dropdown.
	 *
	 * This static method retrieves all available WooCommerce product stock statuses
	 * (e.g., 'in stock', 'out of stock', 'on backorder') and formats them
	 * as `<option>` HTML tags suitable for a `<select>` element.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @return    string HTML string containing `<option>` tags for all stock statuses.
	 */
	public static function get_woo_stock_status_options() {
		// Get all registered WooCommerce product stock status options.
		$all_statuses = wc_get_product_stock_status_options();
		$html         = '';

		// Loop through each status and create an <option> tag.
		foreach ( $all_statuses as $status_name => $status_label ) {
			// Ensure both status_name and status_label are properly escaped for HTML attributes/content.
			$html .= "<option value='" . esc_attr( $status_name ) . "'>" . esc_html( $status_label ) . '</option>';
		}

		return $html;
	}

	/**
	 * Generates HTML for WooCommerce product category options to be used in a select dropdown.
	 *
	 * This static method fetches all product categories (taxonomy `product_cat`),
	 * orders them by name, and filters out empty categories. It then formats them
	 * as `<option>` HTML tags suitable for a `<select>` element in a form.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @return    string HTML string containing `<option>` tags for all product categories.
	 */
	public static function get_woo_product_category_options() {
		$html     = '';
		$all_cats = get_categories(
			array(
				'taxonomy'   => 'product_cat',
				'orderby'    => 'name',
				'hide_empty' => 1, // Only retrieve categories that have products.
			)
		);

		// Loop through each category and create an <option> tag.
		foreach ( $all_cats as $cat ) {
			// Ensure both term_id (value) and name (content) are properly escaped.
			$html .= "<option value='" . esc_attr( $cat->term_id ) . "'>" . esc_html( $cat->name ) . '</option>';
		}

		return $html;
	}

	/**
	 * Generates HTML for WooCommerce product tag options to be used in a select dropdown.
	 *
	 * This static method fetches all product tags (taxonomy `product_tag`),
	 * orders them by name, and filters out empty tags. It then formats them
	 * as `<option>` HTML tags suitable for a `<select>` element in a form.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @return    string HTML string containing `<option>` tags for all product tags.
	 */
	public static function get_woo_product_tags_options() {
		$html     = '';
		$all_tags = get_categories(
			array(
				'taxonomy'   => 'product_tag',
				'orderby'    => 'name',
				'hide_empty' => 1, // Only retrieve tags that have products.
			)
		);

		// Loop through each tag and create an <option> tag.
		foreach ( $all_tags as $tag ) {
			// Ensure both term_id (value) and name (content) are properly escaped.
			$html .= "<option value='" . esc_attr( $tag->term_id ) . "'>" . esc_html( $tag->name ) . '</option>';
		}

		return $html;
	}

	/**
	 * Generates HTML for WooCommerce product attribute options to be used in a select dropdown.
	 *
	 * This static method retrieves all registered WooCommerce product attributes
	 * (e.g., 'Color', 'Size') and formats them as `<option>` HTML tags suitable
	 * for a `<select>` element in a form. The option value will be the attribute's
	 * name, and the displayed text will be its label.
	 *
	 * @since     2.0.0
	 * @static
	 * @access    public
	 * @return    string HTML string containing `<option>` tags for all product attributes.
	 */
	public static function get_woo_attributes_options() {
		$html       = '';
		$attributes = wc_get_attribute_taxonomies(); // Retrieves registered attribute taxonomies.

		// Loop through each attribute and create an <option> tag.
		foreach ( $attributes as $attribute ) {
			// Ensure both attribute_name (value) and attribute_label (content) are properly escaped.
			$html .= "<option value='" . esc_attr( $attribute->attribute_name ) . "'>" . esc_html( $attribute->attribute_label ) . '</option>';
		}

		return $html;
	}
}
