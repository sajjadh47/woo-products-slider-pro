<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package           Woo_Products_Slider_Pro
 * @author            Sajjad Hossain Sagor <sagorh672@gmail.com>
 *
 * Plugin Name:       Free WooCommerce Products Slider/Carousel Pro
 * Plugin URI:        https://wordpress.org/plugins/woo-products-slider-pro/
 * Description:       Display WooCommerce Products in a Carousel. Show Top Rated, Best Selling, ON Sale, Featured, Recently Viewed Products With Category Filter.
 * Version:           2.0.0
 * Requires at least: 5.6
 * Requires PHP:      8.0
 * Author:            Sajjad Hossain Sagor
 * Author URI:        https://sajjadhsagor.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-products-slider-pro
 * Domain Path:       /languages
 * Requires Plugins:  woocommerce
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_VERSION', '2.0.0' );

/**
 * Define Plugin Folders Path
 */
define( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

// Plugin cookie name.
define( 'WOO_PRODUCTS_SLIDER_PRO_PLUGIN_COOKIE_NAME', 'woopspro_recently_viewed_products' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-products-slider-pro-activator.php
 *
 * @since    2.0.0
 */
function on_activate_woo_products_slider_pro() {
	require_once WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'includes/class-woo-products-slider-pro-activator.php';

	Woo_Products_Slider_Pro_Activator::on_activate();
}

register_activation_hook( __FILE__, 'on_activate_woo_products_slider_pro' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-products-slider-pro-deactivator.php
 *
 * @since    2.0.0
 */
function on_deactivate_woo_products_slider_pro() {
	require_once WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'includes/class-woo-products-slider-pro-deactivator.php';

	Woo_Products_Slider_Pro_Deactivator::on_deactivate();
}

register_deactivation_hook( __FILE__, 'on_deactivate_woo_products_slider_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 *
 * @since    2.0.0
 */
require WOO_PRODUCTS_SLIDER_PRO_PLUGIN_PATH . 'includes/class-woo-products-slider-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_woo_products_slider_pro() {
	$plugin = new Woo_Products_Slider_Pro();

	$plugin->run();
}

run_woo_products_slider_pro();
