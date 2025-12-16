=== Free WooCommerce Products Slider/Carousel Pro ===
Tags: product carousel, responsive product slider, slick slider, advanced slider, woo product carousel
Contributors: sajjad67
Author: Sajjad Hossain Sagor
Tested up to: 6.9
Requires at least: 5.6
Stable tag: 2.0.1
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Display WooCommerce Products in a Carousel / Slider. Show Top Rated, Best Selling, ON Sale, Featured, Recently Viewed Products With Category Filter.

== Description ==
WooCommerce Product Carousel / Slider Pro comes with all Pro Features and is one of the best product slider to put your WooCommerce Products listing in a carousal. Choose products from Top Rated Category, Best Selling Category, ON Sale Category, Featured Category Products With Custom Category Filter enabled. You can easily display this product slider anywhere using shortcode.

You can sort product by category, tag, sku or attributes by adding category ID / tag ID / sku / attribute term in the shortcode as a shortcode parameter.

Plugin add a sub tab under "Products --> Product Slider Pro where you can generate your shortcode putting inputs values.

This plugin using the original loop form of WooCommerce that means it will display your product design from your theme's style.

Also work with Gutenberg shortcode block.

= This plugin contain 6 shortcodes =
1) Display any WooCommerce **products** filtered by category / tag / sku / attribute in carousel view

<code>[woopspro_products_slider] OR [woopspro_products_slider cats="CATEGORY-ID" tags="TAG-ID" skus="SKU-VALUE" attribute_color="blue,green,red" attribute_size="medium,big"]</code>

2) Display WooCommerce **Best Selling Products in carousel view**

<code>[woopspro_bestselling_products_slider] OR [woopspro_bestselling_products_slider cats="CATEGORY-ID"]</code>

3) Display WooCommerce **Featured Products in slider / carousel view**

<code>[woopspro_featured_products_slider] OR [woopspro_featured_products_slider cats="CATEGORY-ID"]</code>

4) Display WooCommerce **ON Sale Products in slider / carousel view**

<code>[woopspro_on_sale_products_slider] OR [woopspro_on_sale_products_slider cats="CATEGORY-ID"]</code>

5) Display WooCommerce **Top Rated Products in slider / carousel view**

<code>[woopspro_top_rated_products_slider] OR [woopspro_top_rated_products_slider cats="CATEGORY-ID"]</code>

6) Display WooCommerce **Recently Viewed Products in slider / carousel view**

<code>[woopspro_recently_viewed_products]</code>

= Ordering Products in your slider: =
Plugin shortcodes also has ordering arguments. <code>[woopspro_products_slider order='ASC' orderby='ID']</code> <code>[woopspro_products_slider order='ASC' orderby='meta_value_num' meta_key='your_custom_key']</code>

= Powerful Pro Features =

* Easy Shortcode Generator – No coding required
* Product Sliders for All Types:
    * Best Selling Products
    * Featured Products
    * On Sale Products
    * Top Rated Products
    * Latest / Recent Products
    * Recently Viewed Products
* Advanced Sorting Options:
    * By Category
    * By Tag
    * By SKU
    * By Attributes
    * Custom Order (define your own order)
* 100% Mobile, Tablet & Desktop Responsive
* Smooth Touch & Swipe Enabled Experience
* Translation Ready – Works with multilingual plugins
* Compatible with Any WordPress Theme
* Powered by Slick Slider – Lightweight and efficient
* Fully Customizable Display:
    * Choose the number of columns to show
    * Enable or disable autoplay
    * Show or hide navigation arrows
    * Show or hide pagination dots
    * Unlimited sliders anywhere using shortcodes, widgets, or block widgets
    * Device-specific slide limits (Mobile, Tablet, iPad, Laptop, Desktop)

= You can use Following parameters with shortcode =
* **Display Product by category:** 
cats="category-ID" 
* **Display Product by tag:** 
tags="tag-ID"
* **Display Product by sku:** 
skus="sku-value"
* **Display Product by attribute:** 
attribute_color="red,green,blue" 
* **Display Product by ids (comma seperated ids):** 
ids="45,194,465" 
* **limit:**
limit="5" ( Display total 5 products in the slider. By default value is -1, all)
* **Display number of products at a time:**
slide_to_show="2" (Display no of products in a slider)
* **Display number of products at time for mobile devices:**
slide_to_show_for_mobile="1" (Display no of products in a slider for mobile devices)
* **Display number of products at time for iPads/Tablets devices:**
slide_to_show_for_tablet="2" (Display no of products in a slider for iPads/Tablets devices)
* **Display number of products at time for Laptop/Small devices:**
slide_to_show_for_laptop="3" (Display no of products in a slider for Laptop/Small devices)
* **Number of products slides at a time for mobile devices:**
slide_to_scroll="2" (Controls number of products rotate at a time)
* **Number of products slides at a time:**
slide_to_scroll_for_mobile="2" (Controls number of products rotate at a time for mobile devices)
* **Number of products slides at a time for iPads/Tablets devices:**
slide_to_scroll_for_tablet="2" (Controls number of products rotate at a time for iPads/Tablets devices)
* **Number of products slides at a time for Laptop/Small devices:**
slide_to_scroll_for_laptop="2" (Controls number of products rotate at a time for Laptop/Small devices)
* **Pagination and arrows:**
dots="false" arrows="false" (Hide/Show pagination and arrows. By defoult value is "true". Values are true OR false)
* **Autoplay and Autoplay Speed:**
autoplay="true" autoplay_speed="1000"
* **Slide Speed:**
speed="3000" (Control the speed of the slider)
* **slider_cls:**
slider_cls="products" (This parameter target the wooCommerce default class for product looping. If your slider is not working please check your theme product looping class and add that class in this parameter)

== Installation ==
1. Upload the 'woo-products-slider-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "woo-products-slider-pro" list plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= My Slider is not working =

We have targeted <code><ul class="products"></code> as you can check WooCommerce default class for product looping BUT in your theme i think you have changed the class name from <code><ul class="products"> to <ul class="YOUR_CLASS_NAME"></code>

File under templates-->loop--> loop-start.php

There are simple solution with shortcode parameter

* **slider_cls:**
slider_cls="products" (This parameter target the WooCommerce default class for product looping. If your slider is not working please check your theme product looping class and add that class in this parameter)

== Screenshots ==

1. WooCommerce All Products in carousel view
2. Shortcode Generator
3. WooCommerce Best Selling Products in carousel view
4. WooCommerce Featured Products in carousel view
5. WooCommerce ON Sale Products in carousel view
6. WooCommerce Top Rated Products in carousel view
7. WooCommerce Most Recent Products in carousel view

== Changelog ==
= 2.0.1 =
* Checked for latest wp version 6.9
= 2.0.0 =
* Checked for latest wp version 6.8
= 1.1.4 =
* Minor Update.. tested for latest wp compatibility..
= 1.1.3 =
* Minor Update.. tested for latest wp compatibility..
= 1.1.2 =
* Added woocommerce High Performance Order Storage compatibility.
= 1.1.1 =
* Added order, orderby and meta_key shortcode arguments for ordering your products as your wish.
= 1.1.0 =
* Minor Update.. tested for latest wp & wc compatibility..
= 1.0.9 =
* Added filter for limiting slides for various devices, mobile,tablet,iPad, laptop etc. Checked support for latest version wp and woocommerce.
= 1.0.8 =
* Added Recently Viewed Products shortcode.
= 1.0.7 =
* Added Ajax product & skus search.
= 1.0.6 =
* Added Filter by stock status & checked for latest wc and wp version compatibility.
= 1.0.5 =
* Added Filter by tag, sku & attributes.
= 1.0.4 =
* Added Product IDs Parameter to all shortcodes.
= 1.0.3 =
* Minor Update.. tested for latest wp compatibility..
= 1.0.2 =
* Minor Update.. tested for latest wp compatibility..
= 1.0.1 =
* Minor Update.. tested for latest wp compatibility..
= 1.0 =
* Initial release.