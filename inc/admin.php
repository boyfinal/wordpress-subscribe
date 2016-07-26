<?php

if (!class_exists('Farost_Subscribe_Admin')) {
	/**
	* 
	*/
	class Farost_Subscribe_Admin
	{
		
		function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}

		function admin_menu() {
			add_submenu_page(
				'options-general.php',
		        __( 'Farost subscribe', 'farost_subscribe' ),
		        __( 'Farost subscribe','farost_subscribe' ),
		        'manage_options',
		        'farost-option-subscribe',
		        array($this,'settings_page'),
		        '',
		        80
		    );
		}

		function register_settings() {
		  	register_setting( 'farost_subscribe_options', 'farost_subscribe' );
		}

		function settings_page() {
			require_once __DIR__ . '/views/admin.php';
		}
	}
	new Farost_Subscribe_Admin;
}