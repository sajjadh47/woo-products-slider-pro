<?php
/**
 * This file contains the definition of the Woo_Products_Slider_Pro_I18n class, which
 * is used to load the plugin's internationalization.
 *
 * @package       Woo_Products_Slider_Pro
 * @subpackage    Woo_Products_Slider_Pro/includes
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since    2.0.0
 */
class Woo_Products_Slider_Pro_I18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'woo-products-slider-pro',
			false,
			dirname( WOO_PRODUCTS_SLIDER_PRO_PLUGIN_BASENAME ) . '/languages/'
		);
	}
}
