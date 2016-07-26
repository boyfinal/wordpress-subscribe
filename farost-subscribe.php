<?php
/*
Plugin Name: Farost Subscribe
Plugin URI: #
Description: This is plugin Subscribe
Version: 1.0.0
Author: Farost
Author URI: #
*/

# plugin path
defined('ABSPATH') or exit;

define( 'FAROST_SUBSCRIBE_DIR', plugin_dir_path( __FILE__ ) );
$farost_subscribe_options = get_option('farost_subscribe');

include_once trailingslashit(FAROST_SUBSCRIBE_DIR) . 'inc/mailchip.php';
include_once trailingslashit(FAROST_SUBSCRIBE_DIR) . 'inc/functions.php';
include_once trailingslashit(FAROST_SUBSCRIBE_DIR) . 'inc/widget.php';
if ( is_admin() ) {
	include_once trailingslashit(FAROST_SUBSCRIBE_DIR) . 'inc/admin.php';
}