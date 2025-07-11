<?php
/**
 * This file contains the definition of the Woo_Products_Slider_Pro class, which
 * is used to begin the plugin's functionality.
 *
 * @package       Woo_Products_Slider_Pro
 * @subpackage    Woo_Products_Slider_Pro/includes
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The core plugin class.
 *
 * This is used to define admin-specific hooks and public-facing hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since    2.0.0
 */
class Woo_Products_Slider_Pro {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       Woo_Products_Slider_Pro_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function __construct() {
		$this->version     = defined( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_VERSION' ) ? WOO_PRODUCTS_SLIDER_PRO_PLUGIN_VERSION : '1.0.0';
		$this->plugin_name = 'woo-products-slider-pro';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woo_Products_Slider_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Woo_Products_Slider_Pro_Admin.  Defines all hooks for the admin area.
	 * - Woo_Products_Slider_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'includes/class-woo-products-slider-pro-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'admin/class-woo-products-slider-pro-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'public/class-woo-products-slider-pro-public.php';

		$this->loader = new Woo_Products_Slider_Pro_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Woo_Products_Slider_Pro_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'plugin_action_links_' . WOO_PRODUCTS_SLIDER_PRO_PLUGIN_BASENAME, $plugin_admin, 'add_plugin_action_links' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notices' );

		$this->loader->add_action( 'wp_ajax_woopspro_get_woo_products_option_html', $plugin_admin, 'get_woo_products_options' );
		$this->loader->add_action( 'wp_ajax_woopspro_get_woo_skus_option_html', $plugin_admin, 'get_woo_skus_options' );
		$this->loader->add_action( 'wp_ajax_woopspro_get_product_attributes_terms', $plugin_admin, 'get_product_attributes_terms' );

		$this->loader->add_action( 'before_woocommerce_init', $plugin_admin, 'declare_compatibility_with_wc_custom_order_tables' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function define_public_hooks() {
		$plugin_public = new Woo_Products_Slider_Pro_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'template_redirect', $plugin_public, 'capture_recently_viewed_products' );

		$woopspro_shortcodes = array(
			'woopspro_products_slider',
			'woopspro_bestselling_products_slider',
			'woopspro_featured_products_slider',
			'woopspro_on_sale_products_slider',
			'woopspro_top_rated_products_slider',
			'woopspro_recently_viewed_products',
		);

		foreach ( $woopspro_shortcodes as $shortcode ) {
			add_shortcode( $shortcode, array( $plugin_public, 'shortcode_callback' ) );
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of WordPress.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    Woo_Products_Slider_Pro_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
