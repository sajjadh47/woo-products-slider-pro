# Free Woocommerce Products Slider/Carousel Pro

[![Plugin Banner](https://ps.w.org/woo-products-slider-pro/assets/banner-772x250.png)](https://wordpress.org/plugins/woo-products-slider-pro/)

**Tags:** product carousel, responsive product slider, slick slider, advanced slider, woo product carousel \
**Tested up to:** 6.8 \
**Requires PHP:** 8.0

Display Woocommerce Products in a Carousel / Slider. Show Top Rated Products, Best Selling Products, ON Sale Products And Featured Products With Category Filter.

## Description

WooCommerce Product Carousel / Slider Pro comes with all Pro Features and is one of the best product slider to put your WooCommerce Products listing in a carousal. Choose products from Top Rated Category, Best Selling Category, ON Sale Category, Featured Category Products With Custom Category Filter enabled. You can easily display this product slider anywhere using shortcode.

You can sort product by category by adding category ID in the shortcode as a shortcode parameter.

Plugin add a sub tab under "Products --> Product Slider Pro where you can generate your shortcode putting inputs values.

This plugin using the original loop form of WooCommerce that means it will display your product design from your theme's style.

Also work with Gutenberg shortcode block.

### This plugin contain 5 shortcodes

1) Display any WooCommerce **products** filtered by category in carousel view

<code>[woopspro_products_slider] OR [woopspro_products_slider cats="CATEGORY-ID"]</code>

2) Display WooCommerce **Best Selling Product in carousel view**

<code>[woopspro_bestselling_products_slider] OR [woopspro_bestselling_products_slider cats="CATEGORY-ID"]</code>

3) Display WooCommerce **Featured Product in slider / carousel view**

<code>[woopspro_featured_products_slider] OR [woopspro_featured_products_slider cats="CATEGORY-ID"]</code>

4) Display WooCommerce **ON Sale Product in slider / carousel view**

<code>[woopspro_on_sale_products_slider] OR [woopspro_on_sale_products_slider cats="CATEGORY-ID"]</code>

5) Display WooCommerce **Top Rated Product in slider / carousel view**

<code>[woopspro_top_rated_products_slider] OR [woopspro_top_rated_products_slider cats="CATEGORY-ID"]</code>

### Powerfull Pro Features

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

### You can use Following parameters with shortcode

* **Display Product by category** 
cats="category-ID" 
* **Display Product by ids (comma seperated ids):** 
ids="45,194,465" 
* **limit:**
limit="5" ( ie Display 5 product at time. By defoult value is -1 ie all )
* **Display number of products at time:**
slide_to_show="2" (Display no of products in a slider )
* **Number of products slides at a time:**
slide_to_scroll="2" (Controls number of products rotate at a time)
* **Pagination and arrows:**
dots="false" arrows="false" (Hide/Show pagination and arrows. By defoult value is "true". Values are true OR false)
* **Autoplay and Autoplay Speed:**
autoplay="true" autoplay_speed="1000"
* **Slide Speed:**
speed="3000" (Control the speed of the slider)
* **slider_cls:**
slider_cls="products" (This parameter target the wooCommerce default class for product looping. If your slider is not working please check your theme product looping class and add that class in this parameter)

## Installation

1. Upload the 'woo-products-slider-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "woo-products-slider-pro" list plugin through the 'Plugins' menu in WordPress.

## Frequently Asked Questions

### My Slider is not working

We have targeted `<ul class="products">` as you can check WooCommerce default class for product looping BUT in your theme i think you have changed the class name from `<ul class="products">` to `<ul class="YOUR_CLASS_NAME">`

File under templates-->loop--> loop-start.php

There are simple solution with shortcode parameter

* **slider_cls:**
slider_cls="products" (This parameter target the wooCommerce default class for product looping. If your slider is not working please check your theme product looping class and add that class in this parameter)

## Screenshots

### 1. WooCommerce All Products in carousel view

![WooCommerce All Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-1.png)

### 2. Shortcode Generator

![Shortcode Generator](https://ps.w.org/woo-products-slider-pro/assets/screenshot-2.png)

### 3. WooCommerce Best Selling Products in carousel view

![WooCommerce Best Selling Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-3.png)

### 4. WooCommerce Featured Products in carousel view

![WooCommerce Featured Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-4.png)

### 5. WooCommerce ON Sale Products in carousel view

![WooCommerce ON Sale Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-5.png)

### 6. WooCommerce Top Rated Products in carousel view

![WooCommerce Top Rated Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-6.png)

### 7. WooCommerce Most Recent Products in carousel view

![WooCommerce Most Recent Products in carousel view](https://ps.w.org/woo-products-slider-pro/assets/screenshot-7.png)

## Changelog

### 2.0.2
- Checked for latest wp version 6.8, updated all dependency to latest version & fixed slider layout when only one or two item available but slide_to_show set 3 or more...

### 1.1.4
* Minor Update.. tested for latest wp compatibility..

### 1.1.3
* Minor Update.. tested for latest wp compatibility..

### 1.1.2
* Added woocommerce High Performance Order Storage compatibility.

### 1.1.1
* Added order, orderby and meta_key shortcode arguments for ordering your products as your wish.

### 1.1.0
* Minor Update.. tested for latest wp & wc compatibility..

### 1.0.9
* Added filter for limiting slides for various devices, mobile,tablet,iPad, laptop etc. Checked support for latest version wp and woocommerce.

### 1.0.8
* Added Recently Viewed Products shortcode.

### 1.0.7
* Added Ajax product & skus search.

### 1.0.6
* Added Filter by stock status & checked for latest wc and wp version compatibility.

### 1.0.5
* Added Filter by tag, sku & attributes.

### 1.0.4
* Added Product IDs Parameter to all shortcodes.

### 1.0.3
* Minor Update.. tested for latest wp compatibility..

### 1.0.2
* Minor Update.. tested for latest wp compatibility..

### 1.0.1
* Minor Update.. tested for latest wp compatibility..

### 1.0.0
* Initial release.

## Upgrade Notice

Always try to keep your plugin update so that you can get the improved and additional features added to this plugin up to date.
