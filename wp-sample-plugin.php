<?php
/*
Plugin Name: WordPress Sample Plugin
Plugin URI: https://github.com/aramakiyurie/wp-sample-plugin
Description: WordPress Plugin sample build.
Version: 1.0.0
Author: Yurie Aramaki
Author URI: https://github.com/aramakiyurie/wp-sample-plugin
License: GPLLv2 or later
*/
new Sample_Plugin();

class Sample_Plugin {
	/**
	*Constructer
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

/**
* Add admin menus
*
*@version 1.0.0
*@since   1.0.0
*/
	public function admin_menu() {
		add_menu_page(
			'サンプルA',
			'サンプルB',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'list_page_render' ),
			'dashicons-format-video'
		);
	}
}
